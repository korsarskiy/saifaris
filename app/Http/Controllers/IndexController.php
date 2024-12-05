<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DiyRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $productcolors = ProductColor::all();

        $productcolors = $productcolors->shuffle();

        $productcolors = $productcolors->take(4);

        return view('pages.index', compact('productcolors'));
    }

    public function catalog(Request $request)
    {
        $query = ProductColor::query();

        if ($request->has('categories')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->whereIn('category_id', $request->categories);
            });
        }

        if ($request->has('minPrice') && $request->has('maxPrice')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->whereBetween('price', [$request->minPrice, $request->maxPrice]);
            });
        }

        if ($request->has('lengths')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->whereIn('length', $request->lengths);
            });
        }

        if ($request->has('widths')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->whereIn('width', $request->widths);
            });
        }

        if ($request->has('depths')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->whereIn('depth', $request->depths);
            });
        }

        if ($request->has('colors')) {
            $query->whereIn('name', $request->colors);
        }

        $productcolors = $query->get();
        $categories = Category::all();

        $lengths = Product::distinct()->pluck('length')->filter()->values();
        $widths = Product::distinct()->pluck('width')->filter()->values();
        $depths = Product::distinct()->pluck('depth')->filter()->values();
        $colors = ProductColor::distinct()->pluck('name')->filter()->values();


        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        return view('pages.catalog', compact('categories', 'productcolors', 'lengths', 'widths', 'depths', 'colors', 'minPrice', 'maxPrice'));
    }

    public function product($id)
    {
        $productcolor = ProductColor::query()->findOrFail($id);
        $colors = ProductColor::query()->where('product_id', $productcolor->product_id)->get();
        $images = ProductImage::query()->where('product_color_id', $id)->get();
        return view('pages.product', compact('productcolor', 'colors', 'images'));
    }

    public function admin(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        } else {
            $categories = Category::all();
            $requests = \App\Models\Request::query();
            $diyrequests = DiyRequest::query();

            if ($request->has('sort')) {
                if ($request->sort == 'created') {
                    $requests->where('status', 'Создан');
                    $diyrequests->where('status', 'Создан');
                }
                if ($request->sort == 'accepted') {
                    $requests->where('status', 'Принят');
                    $diyrequests->where('status', 'Принят');
                }
                if ($request->sort == 'canceled') {
                    $requests->where('status', 'Отменен');
                    $diyrequests->where('status', 'Отменен');
                }
            }


            $oneMonthAgo =  Carbon::now()->subMonth();
            \App\Models\Request::query()->where('created_at', '<=', $oneMonthAgo)->delete();
            DiyRequest::query()->where('created_at', '<=', $oneMonthAgo)->delete();

            $requests = $requests->orderBy('id', 'DESC')->get();
            $diyrequests = $diyrequests->orderBy('id', 'DESC')->get();

            return view('pages.admin', compact('categories', 'requests', 'diyrequests'));
        }
    }
}
