<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CutieOfTheYear;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use Illuminate\Support\Facades\Auth;

class CutieOfTheYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vewData()
    {
        $data = CutieOfTheYear::get();
        return view('portal.surveys.cutie_of_the_year')->with('data', $data);
    }

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
            'reciept' => ['required', 'max:6', 'min:4'],
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
            $filename = uniqFile($filename,$ext);
           
            $request->photo->storeAs('cutie_of_the_year/',"$filename",'public');           
         }

         $user = CutieOfTheYear::where('parent_name',  $request->parent_name)
                                ->where('parent_surname',  $request->parent_surname)
                                ->where('child_name',  $request->child_name)
                                ->where('child_surname',  $request->child_surname)
                                ->where('cell_number',  $request->cell_number)
                                ->where('reciept',  $request->reciept)
                                ->first();

         if ( $user) {
           return redirect()->back()->with('error', 'We already have this information in our database, If you have a problem you can contact us at [ careline@mabebeza.co.za ]...');
         }


        $form = new CutieOfTheYear();
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
 
        return redirect()->route('cutie-of-the-year-thanks');
    }

    public function uploadUsers(Request $request)
    {    

        $request->validate([
            'file' => 'required',
        ]);

        $user = Auth::user();
        if (!(strpos($user->email, 'amo') !== false)) {
            return redirect()->back()->with('error', "You don't have access to this function...");
        }
        try {
            $data = Excel::toArray(new ExcelImport, $request->file); 
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'File format not supported, please upload Excel file...');
        }
        $data = $this->arrayToObject($data);
         
        $data = json_encode($data);
        $data = json_decode($data);

        for ($i=0; $i < count($data) ; $i++) {             

            try {
                $user = CutieOfTheYear::where('parent_name',  $data[$i]->{'Parent Name'})
                            ->where('parent_surname',  $data[$i]->{'Parent Surname'})
                            ->where('child_name',  $data[$i]->{'Child Name'})
                            ->where('child_surname',  $data[$i]->{'Child Surname'})
                            ->where('cell_number',  $data[$i]->{'Phone Number'})
                            ->where('reciept',  $data[$i]->{'Reciept Number'})
                            ->first();
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Your Excel header format is incorrect...');
            }

            if ($user) {      continue;    }

            $userData = [
            'parent_name' => $data[$i]->{'Parent Name'},
            'parent_surname' => $data[$i]->{'Parent Surname'},
            'child_name' => $data[$i]->{'Child Name'},
            'child_surname' => $data[$i]->{'Child Surname'},
            'reciept' => $data[$i]->{'Reciept Number'},
            'email' => $data[$i]->{'Email Address'},
            'cell_number' => $data[$i]->{'Phone Number'},
            'store' => $data[$i]->{'Store Name'},
            'photo' => $data[$i]->{'Photo'},
            'created_at' => date('Y-m-d H:i:s', strtotime( $data[$i]->{'Registered At'} )),
            'updated_at' => now(),
            ];
            DB::table('cutie_of_the_years')->insert($userData);
        }                  
        return redirect()->route('cutie-of-the-year-thanks');
    }

    public function thanks()
    {
        return  view('pages.cutie_of_the_year.thanks');
    }

}
