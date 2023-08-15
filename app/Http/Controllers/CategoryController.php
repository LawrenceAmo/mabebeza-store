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

    public function update_main_category(int $id) {

        $category = DB::table('categories')
                        ->where('categoryID', $id)
                        ->first();
 
        return view('portal.category.main_category')->with('category', $category);
    }

    public function update_sub_category(int $id) { 

        $category = DB::table('sub_categories')
                        ->where('sub_categoryID', $id)
                        ->first();

                        // return $category;
 
        return view('portal.category.sub_category')->with('category', $category);
    }

    public function save_main_category(Request $request) {

        $request->validate([
            'name' => 'required',                   
            // 'image' => 'required',                   
          ]);
     
             $category_image_name = $this->upload_category_image($request->image);

              DB::table('categories')
                    ->where('categoryID', (int)$request->categoryID)
                    ->update([
                        'category_name' => $request->name,
                        'category_descript' => $request->description,
                        'category_short_descript' => $category_image_name,
                        'updated_at' => now(),
                     ]);  
        return redirect()->back()->with('success', 'Main Category was created successfully!!!');
    }

    public function save_sub_category(Request $request) {

        $request->validate([
            'name' => 'required',                   
            // 'image' => 'required',                  
          ]);
      
            // return $request;
              DB::table('sub_categories')
                    ->where('sub_categoryID', (int)$request->sub_categoryID)
                    ->update([
                        'sub_category_name' => $request->name,
                        'sub_category_short_descript' => $request->description,
                         'updated_at' => now(),
                     ]);  
        return redirect()->back()->with('success', 'Sub Category was edited successfully!!!');
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

    public function upload_category_image( $image = null)
    {
            if(!$image) return false;      ///// check if file is available if nto do nothing

            $filename = $image->getClientOriginalName();
            $ext = substr($filename,-5);
            
            $uniqName = md5($filename)."".uniqid($filename, true);
            $filename = "cat".md5($uniqName)."ry".$ext;

             $image->storeAs('images/background/',"$filename",'public');

        return $filename;
    }
}
