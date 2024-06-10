<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::paginate(10);;
        return view('menus', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::whereNull('menu_id')->get();
        return view('menuCreate', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'icon' => 'nullable|string',
            'alias' => 'required|string|max:50|unique:menus,alias',
            'show_title' => 'required|boolean',
            'menu_id' => 'nullable|exists:menus,id'
        ]);

        Menu::create($validatedData);

        return redirect()->route('menu.list')->with('success', 'Menu created successfully.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $parentMenus = Menu::whereNull('menu_id')->get();
        $childMenus = $menu->childMenus;
        return view('menu', compact('menu', 'parentMenus', 'childMenus'));
    }

    public function update(Request $request, $id)
    {
        //dd($id);
        $menu = Menu::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'icon' => 'nullable|string',
            'alias' => 'required|string|max:50|unique:menus,alias,' . $menu->id,
            'show_title' => 'required|boolean',
            'menu_id' => 'nullable|exists:menus,id',

        ]);


        // به‌روزرسانی اطلاعات اصلی منو
        $menu->update([
            'menu_id' => $validatedData['menu_id'],
            'title' => $validatedData['title'],
            'link' => $validatedData['link'],
            'alias' => $validatedData['alias'],
            'icon' => $validatedData['icon'],
            'show_title' => $validatedData['show_title'],
        ]);

        // Update child menus order

        if ($request->has('child_menus')) {
            foreach ($request->child_menus as $childMenuData) {
                $childMenu = Menu::findOrFail($childMenuData['id']);

                $childMenu->update([
                    'title' => $childMenuData['title'],
                    'link' => $childMenuData['link'],
                    'alias' => $childMenuData['alias'],
                    'icon' => $childMenuData['icon'],
                    'show_title' => $childMenuData['show_title'],
                    'menu_id' =>  $validatedData['menu_id'],
                ]);
            }
        }

        return redirect()->route('menu.list')->with('success', 'Menu updated successfully.');
    }

    public function delete(Request $request)
    {
        $menu = Menu::findOrFail($request->id);
        $menu->delete();

        return redirect()->route('menu.list')->with('success', 'Menu deleted successfully.');
    }

    public function bulk_action(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('checked_rows', []);

        if ($action == 'delete') {
            Menu::whereIn('id', $ids)->delete();
            return redirect()->route('menu.list')->with('success', 'Selected menus deleted successfully.');
        }

        return redirect()->route('menu.list')->with('error', 'Invalid action selected.');
    }
}
