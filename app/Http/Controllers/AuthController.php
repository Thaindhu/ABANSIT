<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'contact_no' => 'required|size:10',
            'website_url' => 'nullable|url',
            'status' => 'boolean',
            'password' => 'required|min:6',
        ]);
    
        // Create a new supplier instance and fill it with the validated data
        $supplier = new User();
        $supplier->name = $validatedData['name'];
        $supplier->email = $validatedData['email'];
        $supplier->contact_no = $validatedData['contact_no'];
        $supplier->website_url = $validatedData['website_url'];
        $supplier->status = isset($validatedData['status']) ? true : false; // Convert to boolean
        $supplier->password=Hash::make($validatedData['password']);
        $supplier->type=2;
    
        // Save the supplier record to the database
        $supplier->save();

        $message="Supplier Saved Successfuly!";
        return back()->with('success',$message);
    }

    public function loginSupplier(Request $request){
        $credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($credentials)){
            return redirect('/home')->with('success','Login Successfuly!');
        }

        return back()->with('error','Email is worng!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
