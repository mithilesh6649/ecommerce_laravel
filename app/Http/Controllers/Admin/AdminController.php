<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Image;
class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.admin_dashboard');
    }

    public function login(Request $request){
       // $pass = Hash::make(1234);
       // dd($pass);
       if($request->isMethod('post')){
           $data = $request->all();
           
           //dd(config('auth.guards'));
           //dd(\Auth::guard());
          
          $rules = [
              'email' => 'required| email | max:255',
              'password' => 'required',
          ];

          
         $customMessage = [
             'email.required' => 'Email is required',
             'email.email' => 'Vaild Email is required',
             'password.required' => 'Password is required',
         ]; 
         
         $this->validate($request , $rules , $customMessage);

           if(Auth::guard('admin')->attempt([ 'email' => $data['email'] , 'password' => $data['password'] ] , $request->remember ) ){
               return redirect('admin/dashboard');
           }
           else{
             Session::flash('error_message' , 'Invalid Email or Password');  
            return redirect()->back();
           }
       }
         return view('admin.admin_login');
    }


  public function settings(){
       
     $AdminDetails = Admin::Where('email',Auth::guard('admin')->user()->email)->first();
       
      return view('admin.admin_settings')->with(compact('AdminDetails'));
  }



   
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    
    public function checkCurrentPassword(Request $request){
       //  print_r($request->input('current_pwd'));
        // $data = App\Models\Admin::where('password')
       // print_r(Auth::guard('admin')->user()->password);
      if(Hash::check($request->input('current_pwd'),Auth::guard('admin')->user()->password))
       {
       echo "success";
       }
       else{
       echo "failed";
       }
    }


    public function updateCurrentPassword(Request $request){
             if($request->isMethod('post')){
                 $data = $request->all();
                 //print_r($data);
                  //check if current password is correct
                 if(Hash::check($request->input('current_pwd'),Auth::guard('admin')->user()->password))
                 {
                     //Check if new and confirm  password is correct
                    
                    if($data['new_pwd']==$data['confirm_pwd'])
                      {
                        Admin::where('email',Auth::guard('admin')->user()->email)->update(['password' => Hash::make($data['new_pwd']) ]);
                        $request->session()->flash('success_message','Password has been updated successfully !');
                         
                      } 
                      else{
                        $request->session()->flash('error_message','Your new password and confirm password is not matched');
                  
                      }
                 }
                 else{
                    $request->session()->flash('error_message','Your Current Password is incorrect');   
                 }
                 return redirect()->back();
             } 
    }


    //update admin details............

    public function updateAdminDetails(Request $request){
          
          if($request->isMethod('post'))
          {
             
           
             $rules = [
             'admin_name'=>'required|regex:/^[\pL\s\-]+$/u',
             'admin_mobile'=>'required| numeric',
             'admin_image' => 'image',
            ];
           
            $customMessage = array(
              'admin_name.required' => 'Name is required',
              'admin_name.alpha' => 'Valid Name is required',
              'admin_mobile.required' => 'Mobile number is required',
              'admin_mobile.numeric' => 'Valid mobile is required',
              'admin_image.image' => 'Valid image is required',
            );

            $this->validate($request,$rules,$customMessage);
            
            //Upload image
          // dd($request->all());
           
            if($request->hasFile('admin_image')){
                   $image_tmp = $request->file('admin_image');
                 if($image_tmp->isValid()){
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
               
                    $imageName = rand(111,9999).'.'.$extension;
                   $imagePath = 'images/admin_images/admin_photos/'.$imageName;
                   
                   //Upload the image

                   Image::make($image_tmp)->save($imagePath);

                 }
            }else if(!empty($request->input('current_admin_image'))){
                $imageName = $request->input('current_admin_image');
               }else{
                $imageName = " ";
               }  
 
            // Update Admin Details.........
            // dd(Auth::guard('admin')->user()->email);
            Admin::where('email',Auth::guard('admin')->user()->email)->update([
                     'name' => $request->input('admin_name'),
                     'mobile' => $request->input('admin_mobile'),
                     'image' => $imageName,
            ]);

             session::flash('success_message','Admin details updated successfully !');
             return redirect()->back();
          }


         $AdminDetails = Admin::Where('email',Auth::guard('admin')->user()->email)->first();
         return view('admin.update_admin_details',compact('AdminDetails'));
    }

}
