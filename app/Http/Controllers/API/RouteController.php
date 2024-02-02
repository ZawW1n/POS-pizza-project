<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // get product list
    public function productList(){
        $products = Product::get();
        $category = Category::get();
        $user = User::get();
        $order = Order::get();

        $data = [
            'product' => [
                'list' => $products
            ] ,
            'category' => $category,
            'user' => $user,
            'order' => $order
        ];

        return response()->json($data,200);
    }

    public function categoryList(){
        $categories = Category::get();

        return response()->json($categories,200);
    }


    // post create category
    public function createCategory(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ] ;

        $response = Category::create($data);

        return response()->json($response,200);
    }

    // post create contact
    public function createContact(Request $request){
        $data = $this->getContactData($request);

        Contact::create($data);

        $response = Contact::orderBy('created_at','desc')->get();
        return response()->json($response,200);
    }

    // delete category
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
        return response()->json(['status' => true,'message' => 'delete success',$data],200);
        }

        return response()->json(['status' => false,'message' => 'there is no Category...'],500);
    }

    // category details
    public function categoryDetails(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
        return response()->json(['status' => true,'category' => $data],200);
        }

        return response()->json(['status' => false,'category' => 'there is no Category...'],500);
    }

    // category update
    public function categoryUpdate(Request $request){
        $categoryId = $request->category_id;


        if(isset($dbSource)){
            $data = $this->getCategoryData($request);
             Category::where('id',$categoryId)->update($data);

             $response = Category::where('id',$categoryId)->first();
            return response()->json(['status' => true,'message' =>'Category updated success...' ,'category' => $response],200);
            }

            return response()->json(['status' => false,'message' => 'there is no Category...'],500);
    }

    // get category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name ,
            'updated_at' => Carbon::now()
        ];
    }

    // get contact data
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ] ;
    }
}
