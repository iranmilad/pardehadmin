<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Models\SmsSetting;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function index()
    {
        $smsList = Sms::all();
        return view('sms.index', compact('smsList'));
    }

    public function create()
    {
        return view('sms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event' => 'required|string',
            'recipient' => 'required|string',
            'provider' => 'required|string',
            'message' => 'required|string',
        ]);

        Sms::create($request->all());

        return redirect()->route('sms.index')->with('success', 'SMS created successfully.');
    }

    public function edit($id)
    {
        $sms = Sms::findOrFail($id);
        return view('sms.edit', compact('sms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'event' => 'required|string',
            'recipient' => 'required|string',
            'provider' => 'required|string',
            'message' => 'required|string',
        ]);

        $sms = Sms::findOrFail($id);
        $sms->update($request->all());

        return redirect()->route('sms.index')->with('success', 'SMS updated successfully.');
    }

    public function delete(Request $request)
    {
        Sms::destroy($request->id);
        return redirect()->route('sms.index')->with('success', 'SMS deleted successfully.');
    }

    public function bulk_action(Request $request)
    {
        if ($request->action == 'delete') {
            Sms::destroy($request->checked_row);
            return redirect()->route('sms.index')->with('success', 'Selected SMS deleted successfully.');
        }
        return redirect()->route('sms.index');
    }
}
