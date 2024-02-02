<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
       //change password

       public function changePasswordPage(){
        return view('admin.account.changePassword');
        }

        public function changePassword(Request $request){
            $this->validationCheck($request);

            $user = User::select('password')->where('id',Auth::user()->id)->first();
            $dbHashValue = $user->password;

            if(Hash::check($request->oldPassword, $dbHashValue)){
                $data = [
                    'password' => Hash::make($request->newPassword)
                ];

                User::where('id',Auth::user()->id)->update($data);
                return redirect()->route('category#list')->with(['changeSuccess' => 'You Have Changed Password...']);
            }

            return back()->with(['notMatch' => 'The Old Password Not Found. Please Try Again!']);

        }

        //admin list

        public function list(){
            $admin = User::when(request('key'),function($query){
                            $query->orWhere('name','like','%'.request('key').'%')
                                    ->orWhere('name','like','%'.request('key').'%')
                                    ->orWhere('name','like','%'.request('key').'%')
                                    ->orWhere('name','like','%'.request('key').'%')
                                    ->orWhere('name','like','%'.request('key').'%');
                        })
                        ->where('role','admin')->paginate(3);
                        $admin->appends(request()->all());

            return view('admin.account.roleChange',compact('admin'));
        }


        // account delete
        public function delete($id){
            User::where('id',$id)->delete();
            return back()->with(['deleteSuccess' => 'Account Deleted Success']);
        }

        // admin direct details page

        public function details(){
            return view('admin.account.detail');
        }

        // admin direct edit page

        public function edit(){
            return view('admin.account.edit');
        }

        // update account

        public function update($id,Request $request){
            $this->accountValidationCheck($request);
            $data = $this->getUserData($request);

            //for image
            if($request->hasFile('image')){
              $dbImage = User::where('id',$id)->first();
              $dbImage = $dbImage->image;

              if($dbImage != null){
                Storage::delete('public/',$dbImage);
              }

              $fileName = uniqid().$request->file('image')->getClientOriginalName();
              $request->file('image')->storeAs('public',$fileName);
              $data['image'] = $fileName;
            }

            User::where('id',$id)->update($data);
            return redirect()->route('admin#details')->with(['updateSuccess' => 'Admin Account Updated ...']);
        }

        public function change($id,Request $request){
            $data = $this->requestUserData($request);
            User::where('id',$id)->update($data);
            return redirect()->route('admin#list');
        }

        //customer contact message page
        public function messageInfo(){
            $contact = Contact::get();
            return view('admin.category.message',compact('contact'));
        }

        private function requestUserData($request){
            return ['role' => $request->role];
        }

        // request user data
        private function getUserData($request){
            return [
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'phone' => $request->phone,
            'address' => $request->address,
                'updated_at' => Carbon::now()
            ];
        }

        // account data validation
        private function accountValidationCheck($request){
            Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'gender' => ['required'],
            'image' => ['mimes:png,jpg,jpeg,webp|file'],
            'address' => ['required'],
            ])->validate();
        }


            // Password Validation Check
            private function validationCheck($request){
                Validator::make($request->all(),[
                    'oldPassword' => 'required|min:8|max:10' ,
                    'newPassword' => 'required|min:8|max:10' ,
                    'confirmPassword' => 'required|min:8|same:newPassword|max:10' ,
                ])->validate() ;
            }
}
