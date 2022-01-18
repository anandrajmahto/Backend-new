<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class PriceController extends Controller
{
      public function stt_product(Request $request)
    {
        $title = "Products Price/Mrp";
         $email=Session::get('bamaStore');
    	 $store= DB::table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
    	  $logo = DB::table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
         
        $selected =  DB::table('store_products')
                ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                ->where('store_id', $store->store_id)
                ->get();  
                
      
    	return view('store.products.product', compact('title',"store", "logo","selected"));
          
        }
      
    
    
    
 
    
     public function price_update(Request $request)
    {
        $id =$request->id;
        $mrp = $request->mrp;
        $price = $request->price;
    	 $stockupdate = DB::table('store_products')
                ->where('p_id', $id)
                ->update(['mrp'=>$mrp,
                'price'=>$price]);
         if($stockupdate){
            return redirect()->back()->withSuccess('Product prices Updated Successfully'); 
         } else{
         return redirect()->back()->withErrors('something went wrong');
         }

    }
}
