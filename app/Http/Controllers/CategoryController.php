<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Auth;
 
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 111;
        $categories = DB::table('categories')->get();
        $sub_categories = DB::table('sub_categories')
        ->join('categories', 'categories.categoryID', '=', 'sub_categories.categoryID')
        ->get();
       return view('portal.category.index')->with('categories', $categories)->with('sub_categories', $sub_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_main_category(Request $request)
    {
        $request->validate([
            'name' => 'required',                  
            // 'description' => 'required',                  
          ]);

          $category = new Category();
          $category->category_name = $request->name;
          $category->category_short_descript = $request->description;
          $category->save();

        return redirect()->back()->with('success', 'Main Category was created successfully!!!');
    }

    // 
    public function create_sub_category(Request $request)
    {
        $request->validate([
            'name' => 'required',                  
            // 'description' => 'required',                  
            'main_category' => 'required',                  
          ]);

        //   return $request;
          $category = new SubCategory();
          $category->sub_category_name = $request->name;
          $category->sub_category_short_descript = $request->description;
          $category->categoryID	 = (int)$request->main_category;
          $category->save();

        return redirect()->back()->with('success', 'Sub Category was created successfully!!!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
