<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Dotenv\Validator;
use Illuminate\Http\Request;

class productsAPIController extends Controller
{
    public function activeproducts(){
       
        $productsDetails=Products::where('status',1)->get();

        return response()->json(['data' => $productsDetails], 200);
    }

    public function suplier_products(Request $request){

        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:users,id', 
        ]);
        
        $productsDetails=Products::where('supplier_id ',$request->suplier_id)->get();

        return response()->json(['data' => $productsDetails], 200);
    }
}
