<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_color_id' => 'required|numeric',
            'user_name' => 'required|string|max:50',
            'phone' => 'required|size:18',
        ], [
            'required' => 'Заполните поле!',
            'max' => 'Слишком длинное поле!',
            'digits' => 'Укажите корректный номер!',
        ]);

        \App\Models\Request::query()->create($validated);

        return response()->json(['success' => 'Заявка оформлена!']);
    }

    public function accept(\App\Models\Request $request)
    {
        $request->status = 'Принят';
        $request->save();

        return redirect()->route('admin', '#requests')->withErrors(['success'=>'Заявка одобрена!']);
    }

    public function decline(\App\Models\Request $request)
    {
        $request->status = 'Отменен';
        $request->save();

        return redirect()->route('admin', '#requests')->withErrors(['success'=>'Заявка отменена!']);
    }
}
