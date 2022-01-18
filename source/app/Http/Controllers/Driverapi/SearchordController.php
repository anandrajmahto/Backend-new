<?php

namespace App\Http\Controllers\Driverapi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SearchordController extends Controller
{
 
    public function nextdaysearch(Request $request)
    {
        $keyword = $request->keyword;
        $dboy_id = $request->dboy_id;
        $date = date('Y-m-d');
         $day = 1;
         $next_date = date('Y-m-d', strtotime($date.' + '.$day.' days'));
         $ord =DB::table('orders')
             ->join('users', 'orders.user_id', '=','users.user_id')
             ->join('store', 'orders.store_id', '=', 'store.store_id')
             ->join('address', 'orders.address_id','=','address.address_id')
             ->join('delivery_boy', 'orders.dboy_id', '=','delivery_boy.dboy_id')
             ->select('orders.order_status','orders.cart_id','users.user_name', 'users.user_phone', 'orders.delivery_date', 'orders.total_price','orders.delivery_charge','orders.rem_price','orders.payment_status','orders.payment_method','delivery_boy.boy_name','delivery_boy.boy_phone','orders.time_slot', 'store.address as store_address', 'store.store_name','store.phone_number','store.lat as store_lat','store.lng as store_lng','address.lat as userlat', 'address.lng as userlng', 'delivery_boy.lat as dboy_lat', 'delivery_boy.lng as dboy_lng', 'address.receiver_name', 'address.receiver_phone', 'address.city','address.society','address.house_no','address.landmark','address.state')
             ->where('orders.cart_id', 'like', '%'.$keyword.'%')
			->orWhere('users.user_name','like', '%'.$keyword.'%')
             ->where('orders.order_status','!=', 'completed')
             ->where('orders.store_id','!=',0)
             ->where('orders.dboy_id',$dboy_id)
             ->where('orders.delivery_date', $next_date)
             ->orderBy('orders.time_slot', 'ASC')
             ->get();
       
       if(count($ord)>0){
      foreach($ord as $ords){
             $cart_id = $ords->cart_id;    
         $details  =   DB::table('store_orders')
    	               ->where('order_cart_id',$cart_id)
    	               ->where('store_approval',1)
    	               ->sum('store_orders.qty'); 
                  
        
        $data[]=array('payment_method'=>$ords->payment_method,'user_address'=>$ords->house_no.','.$ords->society.','.$ords->city.','.$ords->landmark.','.$ords->state ,'order_status'=>$ords->order_status,'store_name'=>$ords->store_name, 'store_lat'=>$ords->store_lat, 'store_lng'=>$ords->store_lng, 'store_address'=>$ords->store_address, 'user_lat'=>$ords->userlat, 'user_lng'=>$ords->userlng, 'dboy_lat'=>$ords->dboy_lat, 'dboy_lng'=>$ords->dboy_lng, 'cart_id'=>$cart_id,'user_name'=>$ords->user_name, 'user_phone'=>$ords->user_phone, 'remaining_price'=>$ords->rem_price,'delivery_boy_name'=>$ords->boy_name,'delivery_boy_phone'=>$ords->boy_phone,'delivery_date'=>$ords->delivery_date,'time_slot'=>$ords->time_slot,'total_items'=>$details); 
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
        $dboy_id = $request->dboy_id;
          $ord =DB::table('orders')
             ->join('users', 'orders.user_id', '=','users.user_id')
             ->join('store', 'orders.store_id', '=', 'store.store_id')
             ->join('address', 'orders.address_id','=','address.address_id')
             ->join('delivery_boy', 'orders.dboy_id', '=','delivery_boy.dboy_id')
             ->select('orders.order_status','orders.cart_id','users.user_name', 'users.user_phone', 'orders.delivery_date', 'orders.total_price','orders.delivery_charge','orders.rem_price','orders.payment_status','orders.payment_method','delivery_boy.boy_name','delivery_boy.boy_phone','orders.time_slot', 'store.address as store_address', 'store.store_name','store.phone_number','store.lat as store_lat','store.lng as store_lng','address.lat as userlat', 'address.lng as userlng', 'delivery_boy.lat as dboy_lat', 'delivery_boy.lng as dboy_lng', 'address.receiver_name', 'address.receiver_phone', 'address.city','address.society','address.house_no','address.landmark','address.state')
             ->where('orders.cart_id', 'like', '%'.$keyword.'%')
			->orWhere('users.user_name','like', '%'.$keyword.'%')
             ->where('orders.order_status','!=', 'completed')
             ->where('orders.store_id','!=',0)
             ->where('orders.dboy_id',$dboy_id)
             ->where('orders.delivery_date', $today)
             ->orderBy('orders.time_slot', 'ASC')
             ->get();
       
       if(count($ord)>0){
      foreach($ord as $ords){
             $cart_id = $ords->cart_id;    
         $details  =    DB::table('store_orders')
    	               ->where('order_cart_id',$cart_id)
    	               ->where('store_approval',1)
    	               ->sum('store_orders.qty');
                  
        
        $data[]=array('payment_method'=>$ords->payment_method,'user_address'=>$ords->house_no.','.$ords->society.','.$ords->city.','.$ords->landmark.','.$ords->state ,'order_status'=>$ords->order_status,'store_name'=>$ords->store_name, 'store_lat'=>$ords->store_lat, 'store_lng'=>$ords->store_lng, 'store_address'=>$ords->store_address, 'user_lat'=>$ords->userlat, 'user_lng'=>$ords->userlng, 'dboy_lat'=>$ords->dboy_lat, 'dboy_lng'=>$ords->dboy_lng, 'cart_id'=>$cart_id,'user_name'=>$ords->user_name, 'user_phone'=>$ords->user_phone, 'remaining_price'=>$ords->rem_price,'delivery_boy_name'=>$ords->boy_name,'delivery_boy_phone'=>$ords->boy_phone,'delivery_date'=>$ords->delivery_date,'time_slot'=>$ords->time_slot,'total_items'=>$details); 
        }
        }
        else{
            $data[]=array('order_details'=>'no orders found');
        }
        return $data;     
    }     
}
