<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Products;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index(){
        $productId="";
        return view('home', compact('productId'));
    }

    public function view(){
        return view('productList');
    }

    public function store(Request $request){
      
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_code' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'unit_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'boolean',
          ]);

        if($request->productId==""){
        // Create a new product record
        $product=new Products();
        $product->product_name=$request->product_name;
        $product->product_code=$request->product_code;
        $product->description=$request->description;
        $product->unit_price=$request->unit_price; 
        $product->quantity=$request->quantity;  
        $product->status=$request->status;
        if($request->hasFile('photo')){
            $photoPath=$request->file('photo')->store('public/photos');
            $product->image_path=$photoPath;
        }
        $product->supplier_id=Auth::id();
        $product->save();
        $message="Product Saved Successfuly!";
        return back()->with('success',$message);

        }else{
            $product=Products::find($request->productId);
            $product->product_name=$request->product_name;
            $product->product_code=$request->product_code;
            $product->description=$request->description;
            $product->unit_price=$request->unit_price; 
            $product->quantity=$request->quantity;  
            $product->status=$request->status;
            if($request->hasFile('photo')){
                $photoPath=$request->file('photo')->store('public/photos');
                $product->image_path=$photoPath;
            }
            $product->supplier_id=Auth::id();
            $product->update();
            $message="Product Update Successfuly!";
            return back()->with('success',$message);
        }
       
    }

    public function getData(){
        $products = Products::where('supplier_id',Auth::id())->get(); // Replace this with your query for fetching companies

        return DataTables::of($products)->toJson();
    } 

    public function destroyProducts(Request $request){
        try {
            $company=Products::find($request->id);
            if($company){
               $company->delete();
            }
            $message='Deleted Successfuly!';
            $companies = Products::all();
       
            return DataTables::of($companies)
            ->addColumn('status', function ($company) {
                return $company->status ?  'Approved' : 'Not Approved';
            })
            ->toJson(); 
        } catch (\Exception $ex) {
             return redirect()->back()->withErrors(['error' => 'An error Company delete.'+$ex]);
        }
    }

    public function editProducts($productId){ 
        $productsDetails=Products::find($productId);
        return view('edit', compact('productId','productsDetails'));
    }


    // REST API's
    
}