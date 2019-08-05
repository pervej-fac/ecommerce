<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use App\Category;
use App\Brand;
use Illuminate\Http\Request;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title']='Product List';
        $product=new Product();        
        $product=$product->withTrashed();
        if ($request->has('search') && $request->search != null) {
            $product=$product->where('name','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $product=$product->where('status',$request->status);
        }
        $product=$product->orderBy('id','DESC')->paginate(3);
        $data['products']=$product;

        if ($request->search || $request->status) {
            $render['search']=$request->search;
            $render['status']=$request->status;
            $product=$product->appends($render);
        }

        $data['serial']=managePagination($product);
        return view('admin.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']='Create new product';
        $data['categories']=Category::orderBy('name','ASC')->pluck('name','id');
        $data['brands']=Brand::orderBy('name','ASC')->pluck('name','id');
        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'brand_id'=>'required',
            'price'=>'required | numeric',
            'stock'=>'required | numeric',
            'status'=>'required',
            'images.*'=>'image'
        ]);
        $product=$request->except('_token','images');
        $product['created_by']=1;
        $product=Product::create($product);

        if(count($request->images)>=1){
            $this->uploadImage($request->images,$product->id);
        }

        session()->flash('message','Product created successfully');
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title']='Product Details';
        $data['product']=Product::with(['brand','category','product_image'])->findOrFail($id);        
        $data['categories']=Category::orderBy('name','ASC')->pluck('name','id');
        $data['brands']=Brand::orderBy('name','ASC')->pluck('name','id');
        return view('admin.product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data['product']=$product;
        $data['title']='Edit product';
        $data['categories']=Category::orderBy('name','ASC')->pluck('name','id');
        $data['brands']=Brand::orderBy('name','ASC')->pluck('name','id');
        return view('admin.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'brand_id'=>'required',
            'price'=>'required | numeric',
            'stock'=>'required | numeric',
            'status'=>'required',
            'images.*'=>'image'
        ]);
        $product_req=$request->except('_token');
        $product_req['updated_by']=1;
        $product->update($product_req);
        
        /*Image upload*/
        if(count($request->images)>=1){
            $this->uploadImage($request->images,$product->id);
        }

        session()->flash('message','Product updated successfully');
        return redirect()->route('product.index');
    }

    private function uploadImage($images,$product_id){
            foreach($images as $image){
                // $path='images/products';
                $product_image['product_id']=$product_id;
                /*Custom file name */
                $file_name=$product_id.'-'.time().'-'.rand(0000,9999).'.'.$image->getClientOriginalExtension();
                $image->move('images/products/',$file_name);
                $product_image['file_path']='images/products/'.$file_name;
                ProductImage::create($product_image);
            }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('message','Product deleted successfully');
        return redirect()->route('product.index');
    }
    public function restore($id)
    {
        $product=Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        session()->flash('message','Product restored successfully');
        return redirect()->route('product.index');
    }
    public function delete($id)
    {
        $product=Product::onlyTrashed()->with('product_image')->findOrFail($id);
        if(count($product->product_image)){
            foreach($product->product_image as $image){
                File::delete($image->file_path);
                $image->delete();
            }
        }
        $product->forceDelete();
        session()->flash('message','Product permanently deleted successfully');
        return redirect()->route('product.index');
    }
    public function delete_image($image_id)
    {
        $image=ProductImage::findOrFail($image_id);
        File::delete($image->file_path);
        $image->delete();
        session()->flash('message','Product image deleted succesfully');
        return redirect()->back();
    }
}
