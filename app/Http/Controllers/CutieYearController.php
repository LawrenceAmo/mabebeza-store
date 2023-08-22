<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CutieYearController extends Controller
{
   public function index() {
        return view('pages.cutie_of_the_year.index');
    }

    public function create(Request $request, $data=[])
    {
        if (!$request->has([
            'parent_name' , 'parent_surname' , 'child_name' , 'child_surname' , 'reciept' , 'email' , 'cell_number' , 'store' , 'photo' ,
         ])) {
            $data = [
                'parent_name' => '',
                'parent_surname' => '',
                'child_name' => '',
                'child_surname' => '',
                'reciept' => '',
                'email' => '',
                'cell_number' => '',
                'store' => '',
                'photo' => '',
         ];
          }
        return view('pages.cutie_of_the_year.form')->with('data',$data);
    }

    public function save(Request $request)
    {
        $request->validate([
            'parent_name' => ['required','regex:/^[a-zA-Z]+$/u', 'string', 'max:255'],
            'parent_surname' => ['required','regex:/^[a-zA-Z]+$/u', 'string', 'max:255'],
            'child_name' => ['required','regex:/^[a-zA-Z]+$/u', 'string', 'max:255'],
            'child_surname' => ['required','regex:/^[a-zA-Z]+$/u', 'string', 'max:255'],
            'reciept' => ['required', 'max:255'],
            'email' => ['required'],
            'cell_number' => ['required'],
            'store' => 'required',
            'photo' => 'required',
        ]);

        if($request->hasFile('photo')){       ///// check if file is available
            $filename = $request->photo->getClientOriginalName();
            $ext = substr($filename,-5);
           
            // encripting file so that it can be uniq
             function uniqFile($filename,$ext){
                  $file = md5($filename)."".uniqid($filename, true);
                 return "ba".md5($file)."by".$ext;//.$ext;
             } 
            $filename =uniqFile($filename,$ext);
           
            $request->photo->storeAs('survey_img/',"$filename",'public');           
         }

        $form = new Form();
        $form->parent_name = $request->parent_name;
        $form->parent_surname = $request->parent_surname;
        $form->child_name = $request->child_name;
        $form->child_surname = $request->child_surname;
        $form->reciept = $request->reciept;
        $form->email = $request->email;
        $form->cell_number = $request->cell_number;
        $form->store = $request->store;
        $form->photo = $filename;
       $form->save();
 
        return redirect()->route('thanks');
    }

    public function thanks()
    {
        return  view('pages.cutie_of_the_year.thanks');
    }
}
