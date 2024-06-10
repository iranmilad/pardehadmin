<?php

namespace App\Http\Controllers;

use App\Models\BlockWidget;
use App\Models\Widget;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function index(Request $request)
    {
        $query = BlockWidget::query();

        if ($search = $request->input('s')) {
            $query->where('title', 'like', "%{$search}%");
        }

        $blocks = $query->paginate(10);

        return view('blocks', compact('blocks'));
    }

    public function create()
    {
        $widgets = Widget::all();
        return view('block', compact('widgets'));
    }

    public function edit($id)
    {
        $block = BlockWidget::findOrFail($id);
        $widgets = Widget::all();
        return view('block', compact('block', 'widgets'));
    }


    public function store(Request $request)
    {
        $widgetId = $request->input('widget_id');
        $blockName = 'block_'.rand(10000,9999);
        $type = $request->input('setup');
        $settings = $request->except('_token', 'widget_id', 'setup');

        BlockWidget::create([
            'widget_id' => $widgetId,
            'block' => $blockName,
            'type' => $type,
            'settings' => json_encode($settings)
        ]);
        return redirect()->route('blocks.list')->with('success', 'بلاک جدید با موفقیت ایجاد شد.');
    }

    public function update(Request $request, $id)
    {
        $block = BlockWidget::findOrFail($id);
        $block->widget_id = $request->input('widget_id');
        $block->type = $request->input('setup');
        $block->settings = json_encode($request->except('_token', '_method', 'widget_id', 'setup'));
        $block->save();


        return redirect()->route('blocks.list')->with('success', 'بلاک با موفقیت بروزرسانی شد.');
    }

    public function delete($id)
    {

        $block = BlockWidget::findOrFail($id);
        $block->delete();

        return redirect()->route('blocks.list')->with('success', 'بلاک با موفقیت حذف شد.');
    }

    public function bulk_action(Request $request)
    {
        $action = $request->input('bulk_action');
        $ids = $request->input('ids', []);

        if ($action == 'delete' && !empty($ids)) {
            BlockWidget::whereIn('id', $ids)->delete();
            return redirect()->route('blocks.list')->with('success', 'بلاک‌های انتخاب شده با موفقیت حذف شدند.');
        }

        return redirect()->route('blocks.list')->with('error', 'هیچ عملیاتی انتخاب نشده است.');
    }
}
