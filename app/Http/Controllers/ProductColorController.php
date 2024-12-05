<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    public function addColor($id)
    {
       return view('pages.addcolor', compact('id'));
    }

    public function store($id, Request $request)
    {
        $validated = $request->validate([
            'color_name'=>'required|string|max:255',
            'hex' => 'required|string|max:10',
            'img'=>'required|array',
            'img.*'=>'image',
        ], [
            'required'=>'Заполните поле',
            'img.required'=>'Загрузите изображение',
            'image'=>'Файл должен быть изображением!',
            'max' => 'Слишком длинное поле!',
            'numeric' => 'Поле должно быть числом!',
            'between' => 'Укажите корректное число!'
        ]);

        $color = ProductColor::query()->create([
            'product_id'=>$id,
            'name' => $validated['color_name'],
            'hex' => $validated['hex']
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

        return redirect()->route('product', $color->id)->withErrors(['success'=>'Цвет добавлен!']);
    }

    public function destroy(ProductColor $productColor)
    {
        $id = $productColor->product->id;
        $productColor->delete();
        $colors = ProductColor::query()->where('product_id', $id)->get();
        $count = $colors->count();
        if($count==0){
            $product = Product::query()->find($id);
            $product->delete();
            return redirect()->route('catalog')->withErrors(['success'=>'Цвет и товар удален!']);
        }else{
            return redirect()->route('product', $colors->first()->id)->withErrors(['success'=>'Цвет удален!']);
        }
    }

}
