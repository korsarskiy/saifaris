<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'description'=> 'required|string|max:5000',
            'country'=>'required|string|max:255',
            'category_id' =>'required',
            'price'=>'required|numeric|between:0,99999999.99',
            'width'=>'required|numeric|between:0,99999999.99',
            'length'=>'required|numeric|between:0,99999999.99',
            'depth'=>'required|numeric|between:0,99999999.99',
            'material' =>'required|string|max:255',
            '3d_model' => 'required',

            'color_name'=>'required|string|max:255',
            'hex' => 'required|string|max:10',
            'img'=>'required|array',
            'img.*'=>'image',

        ],[
            'required'=>'Заполните поле',
            'img.required'=>'Загрузите изображение',
            'image'=>'Файл должен быть изображением!',
            'max' => 'Слишком длинное поле!',
            '3d_model.required' => 'Выберите файл!',
            'numeric' => 'Поле должно быть числом!',
            'between' => 'Укажите корректное число!'
        ]);

        if ($request->hasFile('3d_model')){
            $validated['3d_model'] ='/public/storage/' . $request->file('3d_model')->store('models', 'public');
        }

        $item = Product::query()->create($validated);
        $color = ProductColor::query()->create([
            'product_id' => $item->id,
            'name' => $validated['color_name'],
            'hex' => $validated['hex'],
        ]);
        if ($request->hasFile('img')) {
            $images = $request->file('img');
            foreach ($images as $image) {
                $path = "/public/storage/" . $image->store('products', 'public');
                ProductImage::query()->create([
                    'img' => $path,
                    'product_color_id' => $color->id
                ]);
            }
        }

        return redirect()->route('product', $color->id)->withErrors(['success'=>'Товар добавлен!']);
    }


    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('pages.editproduct', compact('categories', 'product'));
    }

    public function update(Product $product, Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'description'=> 'required|string|max:5000',
            'country'=>'required|string|max:255',
            'category_id' =>'required',
            'price'=>'required|numeric|between:0,99999999.99',
            'width'=>'required|numeric|between:0,99999999.99',
            'length'=>'required|numeric|between:0,99999999.99',
            'depth'=>'required|numeric|between:0,99999999.99',
            'material' =>'required|string|max:255',
            '3d_model' => 'nullable',
        ], [
            'required'=>'Заполните поле',
            'max' => 'Слишком длинное поле!',
            'numeric' => 'Поле должно быть числом!',
            'between' => 'Укажите корректное число!'
        ]);

        if ($request->hasFile('3d_model')){
            $validated['3d_model'] ='/public/storage/' . $request->file('3d_model')->store('models', 'public');
        }

        $product->update($validated);

        $colorid = ProductColor::query()->where('product_id', $product->id)->first();
        return redirect()->route('product', $colorid->id)->withErrors(['success'=>'Товар изменен!']);
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('catalog')->withErrors(['success'=>'Товар удален!']);
    }
}
