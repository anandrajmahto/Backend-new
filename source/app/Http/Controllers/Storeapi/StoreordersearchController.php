<?php

namespace App\Http\Controllers\Storeapi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class StoreordersearchController extends Controller
{
 
    public function nextdaysearch(Request $request)
    {
        $keyword = $request->keyword;
        $store_id = $request->store_id;
        $date = date('Y-m-d');
         $day = 1;
         $next_date = date('Y-m-d', strtotime($date.' + '.$day.' days'));
          $ord =DB::table('orders')
             ->join('users', 'orders.user_id', '=','users.user_id')
             ->leftJoin('address','orders.address_id','=','address.address_id')
			 ->leftJoin('delivery_boy', 'orders.dboy_id', '=','delivery_boy.dboy_id')
             ->select('orders.cart_id','users.user_name', 'users.user_phone', 'orders.delivery_date', 'orders.total_price','orders.delivery_charge','orders.rem_price','orders.payment_status','delivery_boy.boy_name','delivery_boy.boy_phone','orders.time_slot','orders.order_status','orders.payment_method','users.user_phone','address.*')
			->where('orders.cart_id', 'like', '%'.$keyword.'%')
			->orWhere('users.user_name','like', '%'.$keyword.'%')
			  ->where('orders.store_id',$store_id)
             ->where('payment_method', '!=', NULL)
             ->where('orders.delivery_date',$next_date)
            ->where('orders.order_status','!=','cancelled')
			->where('orders.order_status','!=','Completed')
			->orderByRaw("FIELD(order_status , 'Pending', 'Confirmed', 'Out_For_Delivery', 'Completed') ASC")
             ->get();
       
       if(count($ord)>0){
      foreach($ord as $ords){
             $cart_id = $ords->cart_id;    
         $details  =   DB::table('store_orders')
    	               ->where('order_cart_id',$cart_id)
    	               ->where('store_approval',1)
    	               ->get(); 
                  
        
        $data[]=array('user_address'=>$ords->house_no.','.$ords->society.','.$ords->city.','.$ords->landmark.','.$ords->state.','.$ords->pincode, 'cart_id'=>$cart_id,'user_name'=>$ords->user_name, 'user_phone'=>$ords->user_phone, 
        'remaining_price'=>$ords->rem_price,'order_price'=>$ords->total_price,'delivery_boy_name'=>$ords->boy_name,'delivery_boy_phone'=>$ords->boy_phone,'delivery_date'=>$ords->delivery_date,'time_slot'=>$ords->time_slot,'payment_mode'=>$ords->payment_method, 'order_status'=>$ords->order_status, 'customer_phone'    =>$ords->user_phone,'order_details'=>$details); 
        }
        }
        else{
            $data[]=array('order_details'=>'no orders found');
        }
        return $data;     
    }
    
     public function todaysearch(Request $request)
    {
        $today = date('Y-m-d');
         
        $keyword = $request->keyword;
        $store_id = $request->store_id;
          $ord =DB::table('orders')
             ->join('users', 'orders.user_id', '=','users.user_id')
             ->leftJoin('address','orders.address_id','=','address.address_id')
			 ->leftJoin('delivery_boy', 'orders.dboy_id', '=','delivery_boy.dboy_id')
             ->select('orders.cart_id','users.user_name', 'users.user_phone', 'orders.delivery_date', 'orders.total_price','orders.delivery_charge','orders.rem_price','orders.payment_status','delivery_boy.boy_name','delivery_boy.boy_phone','orders.time_slot','orders.order_status','orders.payment_method','users.user_phone','address.*')
			->where('orders.cart_id', 'like', '%'.$keyword.'%')
			->orWhere('users.user_name','like', '%'.$keyword.'%')
			  ->where('orders.store_id',$store_id)
             ->where('payment_method', '!=', NULL)
             ->where('orders.delivery_date',$today)
            ->where('orders.order_status','!=','cancelled')
			->where('orders.order_status','!=','Completed')
			->orderByRaw("FIELD(order_status , 'Pending', 'Confirmed', 'Out_For_Delivery', 'Completed') ASC")
             ->get();
       
       if(count($ord)>0){
      foreach($ord as $ords){
             $cart_id = $ords->cart_id;    
         $details  =   DB::table('store_orders')
    	               ->where('order_cart_id',$cart_id)
    	               ->where('store_approval',1)
    	               ->get(); 
                  
        
        $data[]=array('user_address'=>$ords->house_no.','.$ords->society.','.$ords->city.','.$ords->landmark.','.$ords->state.','.$ords->pincode, 'cart_id'=>$cart_id,'user_name'=>$ords->user_name, 'user_phone'=>$ords->user_phone, 
        'remaining_price'=>$ords->rem_price,'order_price'=>$ords->total_price,'delivery_boy_name'=>$ords->boy_name,'delivery_boy_phone'=>$ords->boy_phone,'delivery_date'=>$ords->delivery_date,'time_slot'=>$ords->time_slot,'payment_mode'=>$ords->payment_method, 'order_status'=>$ords->order_status, 'customer_phone'    =>$ords->user_phone,'order_details'=>$details); 
        }
        }
        else{
            $data[]=array('order_details'=>'no orders found');
        }
        return $data;     
    }
}
