<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductMail;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    
        $product=Product::with('category')->get();
        return view('product' , compact('product'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         $categoryLists = Category::where('is_active',1)->get();
         return view('product_create', compact('categoryLists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $request= $request->validate([
        //     'name'=> 
          // 'image' => 'nullable|image|mimes:jpg,jpeg,png'
        // ]);
        //dd($request->all());
        $product = Product::where('name', $request->name)->first();
        if($product){
            return redirect()->route('products.create')->with('error', 'already exists');
        }
        $imageName=null;
        if($request->hasFile('image')){
            //imge 
            $imageName = time().'-.'.$request->image->extension();
            $request->image->storeAs(
                'products',$imageName,'public'
            );
        }
        Product::create([
            'name'=>$request->name,
            'category_id' => $request->category_id,
            'is_active' => $request->is_active,
            'price' => $request->price,
            'imageName' => $imageName
        ]);

        Mail::to('test@gmail.com')->send(new ProductMail($product));

        return redirect()->route('products.index')->with('success', 'added product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $categoryLists = Category::all();
//        dd($product);

        return view('product_create', compact('product', 'categoryLists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $imageName = $product->image;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' .
                        $request->image->extension();

            $request->image->storeAs(
                'products',
                $imageName,
                'public'
            );
        }
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'price' => $request->price,
            'image' => $imageName
        ]);

        return redirect()->route('products.index')->with('success', 'upate easily');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
