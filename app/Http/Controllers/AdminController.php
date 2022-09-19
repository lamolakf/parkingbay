<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\admins;
use App\Models\parkingbays;
use App\Models\parking_entries;
use App\Models\security_guards;



class AdminController extends Controller
{
    /**
     * redirect admin after login
     *
     * @return \Illuminate\View\View
     */
    public function getGaurd()
    {
        //$data["USER"]= auth()->guard('schooladmin')->user();
       
        $data["security_guards"]=security_guards::all();
        return view('gaurd.addGuard',$data);
    }





    public function storeGaurd(Request $request)
    {
        //dd($request);
        //$data["USER"]= auth()->guard('schooladmin')->user();
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|alpha',
            'lastName' => 'required|string|alpha',
            'email'=>'required|email|unique:security_guards',
        ],[
            'name.alpha'=>'Enter valid name',
            'lastName.alpha'=>'Enter valid last name',
        ]);

        if(!$validator->fails())
        {
            
            $guard= new security_guards();
         
            $guard->name=$request->name;
            $guard->lastName=$request->lastName;
            $guard->email=$request->email;
            $guard->save();  

            return response()->json(['success'=>'Gaurd is successfully added']);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        
    }


   public function updateGaurd(Request $request)
   {
             /*  dd($request); */
             $validator = \Validator::make($request->all(), [
                'name' => 'required|string|alpha',
                'lastName' => 'required|string|alpha',
                'email' => 'required|email|unique:security_guards,email,'.$request->id.',id',
              
            ],[
              
                'name.alpha'=>'Enter valid name',
                'lastName.alpha'=>'Enter valid last name',
            ]);
            
         
            if(!$validator->fails())
            {
    
                $security_guards=security_guards::where("id", $request->id)->update(['name'=>$request->name,
                'lastName'=>$request->lastName,
            'email'=>$request->email]);
              
    
                return response()->json(['success'=>'gaurd is successfully added']);
            }
           
    
            if ($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }
   }

   



    public function deleteGaurd(Request $request)
    {
      
        $security_guards=security_guards::where('id','=',$request->id);
        $security_guards->delete();
        return response()->json(['success'=>'guard is successfully deleted']);      
    }

    public function delAdmin(Request $request)
    {
        $security_guards=admins::where('id','=',$request->id);
        $security_guards->delete();
        return response()->json(['success'=>'guard is successfully deleted']); 
    }

    public function Fingerguard(Request $request)
    {
        $security_guards=security_guards::where("id", $request->id)->update(['fingerId'=>$request->fingerId]);
        return response()->json(['success'=>'fingerId is successfully updated']);
    }


    public function getAdmin(Request $request)
    {
        $data["security_guards"]=admins::all();
        return view('admin.admin',$data);
    }
    public function storeAdmin(Request $request){

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|alpha',
            'lastName' => 'required|string|alpha',
            'email'=>'required|email|unique:admins',
        ],[
            'name.alpha'=>'Enter valid name',
            'lastName.alpha'=>'Enter valid last name',
        ]);

        if(!$validator->fails())
        {
            
            $admin= new admins();
         
            $admin->name=$request->name;
            $admin->lastName=$request->lastName;
            $admin->email=$request->email;
            $admin->save();  

            return response()->json(['success'=>'Admin is successfully added']);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

    }
    public function updateAdmin(Request $request){}
    public function delguard(Request $request){}

    public function bayUpdate(Request $request)
    {
        //dd($request);
        $parkingbays=parkingbays::where("id",1)->update(['number_of_bays'=>$request->bay]);
        return response()->json(['success'=>'bay is successfully updated']);
    }

    public function entriesSec($security,$driver)
    {
        $parking_entries= new parking_entries();
        $parking_entries->guardId =$security;
        $parking_entries->driver_code =$driver;
        $parking_entries->save(); 

        return response()->json(['success'=>'bay is successfully updated']);
    }

    public function entriesDr($security)
    {
        $parking_entries= new parking_entries();
        $parking_entries->driver_code =$security;
        $parking_entries->save(); 

        return response()->json(['success'=>'bay is successfully updated']);
    }
}