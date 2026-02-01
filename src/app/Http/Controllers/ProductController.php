<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // 🔍 商品名検索（部分一致）
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // ↕ 並び替え（価格）
        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        }

        // 📄 ページネーション（6件固定）
        $products = $query->paginate(6)->withQueryString();

        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string'],
            'price'       => ['required', 'integer', 'between:0,10000'],
            'image'       => ['required', 'file', 'mimes:png,jpeg'],
            'season'      => ['required'],
            'description' => ['required', 'string', 'max:120'],
        ]);

    // 画像保存
        $path = $request->file('image')->store('image', 'public');

        Product::create([
            'name'        => $validated['name'],
            'price'       => $validated['price'],
            'image'       => basename($path),
            'season'      => $validated['season'],
            'description' => $validated['description'],
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', '商品を登録しました');
    }
}
