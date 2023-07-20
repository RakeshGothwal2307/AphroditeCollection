<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\UserModel;

class UsersController extends Controller
{
    public function get_users_list(){  
        $users_list = UserModel::all();        
        return view('admin/users/index', compact('users_list'));
    }

    public function insert_users(Request $request){
        $formdata = $request->all(); //dd($formdata);

        $user = new UserModel;
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->plain_password = $request->password;
        $user->country = $request->country;
        $user->terms = "on";
        $user->status = $request->user_status;
        $user->save();

        if($user->id > 0){
            ////Send Mail to Register User Email////      
            //Mail::to($formdata['email'])->send(new UserRegistration($formdata));
            return back()->with('flash-success', 'You Have Successfully Added A User.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }
    }

    
    public function check_email_existance(Request $request){
        $formdata = $request->all(); //dd($formdata);
        if ($request['existance_type'] == 'uemail'){             
            $checkuser = UserModel::where('email', '=', $request['useremail'])->count(); 
            //dd($checkuser); 
            if($checkuser == 0){
                echo 'true';    //Good To Register
            } else {
                echo 'false';    //Already Register
            }
        }
    }
    

    public function edit_users(Request $request){
        $formdata = $request->all(); //dd($formdata);
        $hidden_user_id = $formdata['hidden_user_id']; 

        $edit_user = UserModel::find($hidden_user_id);

        $edit_user->first_name = $formdata['firstname'];
        $edit_user->last_name = $formdata['lastname'];
        $edit_user->email = $formdata['email'];
        if($formdata['password']){
            $edit_user->password = Hash::make($formdata['password']);
            $edit_user->plain_password = $formdata['password'];
        }        
        $edit_user->country = $formdata['country'];
        $edit_user->status = $formdata['user_status'];
        $edit_user->save();
        //Last inserted ID
        if($edit_user->id > 0){            
            return back()->with('flash-success', 'You Have Successfully Updated User.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }
    }


    public function delete_users($id){
        //dd($id);
        $data = UserModel::find($id)->delete();
        if($data){   
            return back()->with('flash-success', 'You Have Successfully Deleted A User.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }
    }
}
