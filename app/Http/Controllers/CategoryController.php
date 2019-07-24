<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        $data['title']='Category List';
        $category=new Category();        
        $category=$category->withTrashed();
        if ($request->has('search') && $request->search != null) {
            $category=$category->where('name','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $category=$category->where('status',$request->status);
        }
        $category=$category->orderBy('id','DESC')->paginate(2);
        $data['categories']=$category;
        // $data['categories']=Category::withTrashed()->orderBy('id','DESC')->paginate(2);
        // dd($data);
        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']='Create new category';
        return view('admin.category.create', $data);
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
            'status'=>'required'
        ]);
        $category=$request->except('_token');
        $category['created_by']=1;
        Category::create($category);
        session()->flash('message','Category created successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data['title']='Edit category';
        $data['category']=$category;
        return view('admin.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required'
        ]);
        $category_req=$request->except('_token','_method');
        $category_req['updated_by']=1;
        $category->update($category_req);
        session()->flash('message','Category updated successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('message','Category deleted successfully');
        return redirect()->route('category.index');
    }
    public function restore($id)
    {
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        session()->flash('message','Category restored successfully');
        return redirect()->route('category.index');
    }
    public function delete($id)
    {
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        session()->flash('message','Category permanently deleted successfully');
        return redirect()->route('category.index');
    }
}
