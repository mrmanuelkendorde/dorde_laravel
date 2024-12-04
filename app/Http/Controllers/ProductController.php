<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('is_deleted', false)->get();
        $products = Product::where('is_deleted', false)->get();

        return view ('products', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_deleted', false)->get();

        return view('product-form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_image' => 'nullable|image|mimes:png, jpg, jpeg|max:5012',
            'product_name' => 'required|unique:products,product_name',
            'product_category'=> 'required|exists:categories,category_id',
            'price'=> 'required|decimal:0,2',
            'stocks' => 'required|integer|min:0',
        ]);
    
        if ($request->hasFile('product_image')) {
            $filenameWithExtension = $request->file('product_image')->getClientOriginalName();
            $filname = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extensiom = $request->file('product_image')->getClientOrignalExtension();
            $filenameToStore = $filename . '-' . time() . '.'. $extensions;
            $request->file('product_image')->storeAS('Uploads/Product Images', $filenametoStore);
            $validated['product_image'] = $filenametoStore;
        }
        $validated['category_id'] = $request->product_category;

        $product = Product::create($validated);

        if(!$product){
            return redirect()->route('products')->with([
                'message' => 'Unable to add new product',
                'type' => 'error'
            ]);
        }

        return redirect()->route('products')->with([
            'message' => 'Product added successfully',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $product_id)
    {
        $product = Product::findorfail($product_id);
        $categories = Category::where('is_deleted', false)->get();

        return view('product-form', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product_id)
    {
        $product = Product::findorfail($product_id);
        
        $validated = $request->validate([
            'product_image' => 'nullable|image|mimes:png, jpg, jpeg|max:5012',
            'product_name' => 'required|unique:products,product_name,' .$product_id. ',product_id',
            'product_category'=> 'required|exists:categories,category_id',
            'price'=> 'required|decimal:0,2',
            'stocks' => 'required|integer|min:0',
        ]);
    
        if ($request->hasFile('product_image')) {
            $filenameWithExtension = $request->file('product_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extensions = $request->file('product_image')->getClientOriginalExtension();
            $filenameToStore = $filename . '-' . time() . '.'. $extensions;
            $request->file('product_image')->storeAS('Uploads/Product Images', $filenameToStore);
            $validated['product_image'] = $filenameToStore;
        }
        $validated['category_id'] = $request->product_category;

        if($product->update($validated)){
            return redirect()->route('products')->with([
                'message' => 'Product added successfully',
                'type' => 'error'
            ]);
        }

        return redirect()->route('products')->with([
            'message' => 'Unable to update Product',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $product_id)
    {
        $product = Product::findorfail($product_id);

        $product->is_deleted = true;

        $product->save();
        
        return redirect()->route('products')->with([
            'message' => 'Product added successfully',
            'type' => 'success'
        ]);
    }
}
