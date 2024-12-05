<?php

namespace App\Http\Controllers;

use App\Models\DiyRequest;
use Illuminate\Http\Request;

class DiyRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|max:255',
            'user_name' => 'required|string|max:50',
            'phone' => 'required|size:18',
        ], [
            'required' => 'Заполните поле!',
            'max' => 'Слишком длинное поле!',
            'size' => 'Укажите корректный номер!',
        ]);

        DiyRequest::query()->create($validated);

        return response()->json(['success' => 'Заявка оформлена!']);
    }

    public function accept(DiyRequest $diyRequest)
    {
        $diyRequest->status = 'Принят';
        $diyRequest->save();

        return redirect()->route('admin', '#requests')->withErrors(['success'=>'Заявка одобрена!']);
    }

    public function decline(DiyRequest $diyRequest)
    {
        $diyRequest->status = 'Отменен';
        $diyRequest->save();

        return redirect()->route('admin', '#requests')->withErrors(['success'=>'Заявка отменена!']);
    }
}
