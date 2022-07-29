<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use App\Services\ProductService;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Category Service
     * 
     * @var \App\Services\ProductService productServices
     */
    protected $productService;

    /**
     * Contructor.
     *
     * @param ProductService $productService.
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::orderBy('name', 'ASC')->select('id', 'name')->get();
        $data = Product::search()->paginate(5);

        return view('admin.product.index', compact('data', 'cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::orderBy('name', 'ASC')->select('id', 'name')->get();
        return view('admin.product.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));
        $product->qty = $request->input('qty');
        $product->price = $request->input('price');
        $product->entry_price = $request->input('entry_price');
        $product->status = $request->input('status');
        $product->category_id = $request->input('category_id');
        $product->sale_price = $request->input('sale_price');
        // dd($product);
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $product->image = $filename;
        }
        $product->save();
        return redirect()->route('product.index')->with('success', 'Thêm mới sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $cats = Category::orderBy('name', 'ASC')->select('id', 'name')->get();
        return view('admin.product.edit', compact('product', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->qty = $request->input('qty');
        $product->price = $request->input('price');
        $product->status = $request->input('status');
        $product->entry_price = $request->input('entry_price');
        $product->category_id = $request->input('category_id');
        $product->sale_price = $request->input('sale_price');
        if ($request->hasfile('image')) {
            $destination = 'public/uploads/' . $product->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $product->image = $filename;
        }
        $product->update();
        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productService->destroy($id);

        return redirect()->route('product.index')->with('success', 'Xóa sản phẩm thành công');
    }
}