<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class PayController extends Controller
{

    public function updatepymntvia(Request $request)
    {
       $pymnt_via = $request->pymnt_via;
        if ($pymnt_via == 'razor'){
            $razorpay = 1;
            $paypal = 0;
            $paystack = 0;
        }
        elseif ($pymnt_via == 'paypal'){
        $razorpay = 0;
        $paypal = 1; 
        $paystack = 0;
        
        }
        elseif($pymnt_via == 'paystack'){
        $razorpay = 0;
        $paypal = 0; 
        $paystack = 1;  
        }
        elseif($pymnt_via == 'paystackrazor'){
        $razorpay = 1;
        $paypal = 0; 
        $paystack = 1;  
        }
        elseif($pymnt_via == 'paystackpaypal'){
        $razorpay = 0;
        $paypal = 1; 
        $paystack = 1;  
        }
        elseif($pymnt_via == 'razorpaypal'){
        $razorpay = 1;
        $paypal = 1; 
        $paystack = 0;  
        }
        else{
            $razorpay = 1;
            $paypal = 1; 
            $paystack = 1;
        }
        $check = DB::table('payment_via')
               ->first();
       
    
      if($check){
        $update = DB::table('payment_via')
                ->update(['razorpay'=> $razorpay,'paypal'=> $paypal, 'paystack'=>$paystack]);
    
      }
      else{
          $update = DB::table('payment_via')
                ->insert(['razorpay'=> $razorpay,'paypal'=> $paypal, 'paystack'=>$paystack]);
      }
     if($update){
              
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Nothing to Update');
     }
    }
    
}