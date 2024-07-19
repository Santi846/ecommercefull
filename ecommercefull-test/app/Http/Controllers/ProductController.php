<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SellerToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductsFormRequest;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user instanceof SellerToken) {
            $sellerToken = $user->sellerToken;
            $products = $sellerToken ? $sellerToken->products : [];
            return view('products.index', compact('products'));
        }
        return redirect('/')->with('error', 'Unauthorized');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductsFormRequest  $request)
    {
        $validated = $request->validated();

        Product::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'currency' => $validated['currency'],
            'prize' => $validated['prize'],
            'stock' => $validated['stock']
        ]);

        

        $products = Product::all();
        $sellers = SellerToken::all();
        return view('seller', ['products' => $products], ['sellers' => $sellers]);
       
    }

    public function showProduct()
{
    $products = Product::all();
    return view('seller', ['products' => $products]);
}

    
    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('products.edit', ['products' => $products]);
    }

    public function update(ProductsFormRequest $request, $id)
    {
        $validated = $request->validated();

        $product = Product::findOrFail($id);
        $product->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'currency' => $validated['currency'],
            'prize' => $validated['prize'],
            'stock' => $validated['stock'],
        ]);

        return redirect()->route('seller.index')->with('message', 'El artículo fue actualizado correctamente.');
    }



    public function destroy(string $id)//: RedirectResponse
    {
        Product::destroy($id);
        $products = Product::all();
        $sellers= SellerToken::all();
        return view('seller', ['sellers' => $sellers] , ['products' => $products]);
    }
}
