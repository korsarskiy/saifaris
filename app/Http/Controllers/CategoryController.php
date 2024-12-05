<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cat_name' => 'required|string|max:255'
        ], [
            'required' => 'Заполните поле!',
            'string' => 'Поле должно быть строкой!',
            'max' => 'Слишком длинное название'
        ]);

        Category::query()->create([
            'name'=> $validated['cat_name']
        ]);

        return redirect()->route('admin')->withErrors(['success' => 'Категория добавлена!']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin')->withErrors(['success' => 'Категория удалена!']);
    }
}
