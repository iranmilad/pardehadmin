<?php

namespace App\Http\Controllers\Order;

use App\Components\Cart\Cart;
use App\Components\Delivery\Address;
use App\Components\Delivery\Calculator;
use App\Components\Delivery\Services;
use App\Exceptions\DeliveryApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * @var Address
     */
    protected $deliveryAddress;

    /**
     * @var Services
     */
    protected $deliveryServices;

    /**
     * @var Calculator
     */
    private $deliveryCalculator;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * DeliveryController constructor.
     * @param Address $address
     * @param Services $services
     * @param Calculator $calculator
     * @param Cart $cart
     */
    public function __construct(Address $address, Services $services, Calculator $calculator, Cart $cart)
    {
        $this->middleware('order');
        $this->deliveryAddress = $address;
        $this->deliveryServices = $services;
        $this->deliveryCalculator = $calculator;
        $this->cart = $cart;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function delivery()
    {
        try {
            $regions = $this->deliveryAddress->getRegionList();
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.delivery.address')
                ->with('regions', $regions)
                ->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function region(Request $request)
    {
        try {
            $cities = $this->deliveryAddress->getAreasList($request->region);
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.delivery.item_list')
                ->with('items', $cities)
                ->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function city(Request $request)
    {
        try {
            $warehouses = $this->deliveryAddress->getWarehousesListInDetail($request->city, 25);
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.delivery.item_list')
                ->with('items', $warehouses)
                ->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function warehouse(Request $request)
    {
        try {
            $this->deliveryServices->setReceiveInfo($request->warehouse);

            $arrivalDate = $this->deliveryServices->getDateArrival();
            $additionalServices = $this->deliveryServices->getDopUslugiClassification();
            $tarif = $this->deliveryServices->getTariffCategory();
            $deliveryScheme = $this->deliveryServices->getDeliveryScheme();
            $warehouse = $this->deliveryAddress->getWarehousesInfo($request->warehouse);
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.delivery.warehouse')
                ->with('warehouse', $warehouse)
                ->with('arrivalDate', $arrivalDate)
                ->with('schemes', $deliveryScheme)
                ->with('tarifs', $tarif)
                ->with('additionalServices', $additionalServices)
                ->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function category(Request $request)
    {
        try {
            $categories = $this->deliveryServices->getCargoCategory($request->tarif);
        } catch (DeliveryApi $e) {
            return response()->json(['message' => $e->getMessage()], 501);
        }
        return response()->json([
            'content' => view('partials.order.form.delivery.categories')
                ->with('categories', $categories)
                ->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws DeliveryApi
     * @throws \App\Exceptions\DifferentCurrencies
     */
    public function calculation(Request $request)
    {
        $shippingPrice = $this->deliveryCalculator
            ->setReceiveInfo($request->warehouse)
            ->setCashOnDeliveryValue()
            ->setInsuranceValue()
            ->setDeliveryScheme($request->scheme)
            ->setCategory($request->category)
            ->setDopUsluga($request->dopUslugi)
            ->setDateSend()
            ->postReceiptCalculate();
        return response()->json([
            'shippingPrice' => $shippingPrice->format(),
            'totalPrice' => $shippingPrice->add($this->cart->totalPrice())->format()
        ]);
    }
}
