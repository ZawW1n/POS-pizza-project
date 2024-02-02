<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home(){
        $pizza = Product::orderBy('price','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('pizza','category','cart','history'));
    }

    // change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //change password
    public function changePassword(Request $request){
        $this->validationCheck($request);

            $user = User::select('password')->where('id',Auth::user()->id)->first();
            $dbHashValue = $user->password;

            if(Hash::check($request->oldPassword, $dbHashValue)){
                $data = [
                    'password' => Hash::make($request->newPassword)
                ];

                User::where('id',Auth::user()->id)->update($data);
                return redirect()->route('user#home')->with(['changeSuccess' => 'You Have Changed Password...']);
            }

            return back()->with(['notMatch' => 'The Old Password Not Found. Please Try Again!']);
    }

    // account edit page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    // direct cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                            ->leftJoin('products','products.id','carts.product_id')
                            ->where('user_id',Auth::user()->id)->get();

        $priceTotal = 0;
        foreach($cartList as $c){
            $priceTotal += $c->pizza_price*$c->qty;
        }
        return view('user.main.cart',compact('cartList','priceTotal'));
    }

    // category filter
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('price','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('pizza','category','cart','history'));
    }

    // account change
    public function accountChange($id,Request $request){
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
            return back()->with(['updateSuccess' => 'Admin Account Updated ...']);
    }

    // direct contact to admin page
    public function contactToAdmin(){
       return view('user.main.contact');
    }

    // direct send message
    public function sendMessage(Request $request){
        $contact = $this->requestContactInfo($request);
        Contact::create($contact);
        return redirect()->route('user#home');
    }

    // direct pizza details
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    // direct user change role list
    public function userList(Request $request){
        $users = User::where('role','user')->paginate('3');
        return view('admin.user.changeList',compact('users'));
    }

    // change user role
    public function userChangeRole(Request $request){
        $updateSource = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($updateSource);

    }

     // change admin role
     public function adminChangeRole(Request $request){
        $updateDataSource = [
            'role' => $request->role
        ];

        User::where('id',$request->adminId)->update($updateDataSource);
    }


    // direct history page
    public function history(){
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->paginate('6');
        return view('user.main.history',compact('order'));
    }

    // Password Validation Check
    private function validationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:8|max:10' ,
            'newPassword' => 'required|min:8|max:10' ,
            'confirmPassword' => 'required|min:8|same:newPassword|max:10' ,
        ])->validate() ;
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

    //account data validation
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

    //request contact info
    private function requestContactInfo($request){
        return[
            'name' => $request->Name ,
            'email' => $request->Email,
            'message' => $request->Message ,
        ];
    }

}
