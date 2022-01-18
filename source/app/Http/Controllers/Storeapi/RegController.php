<?php
namespace App\Http\Controllers\Storeapi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class RegController extends Controller
{
 public function regstore(Request $request)
    
     {
        $store_name = $request->store_name;
        $emp_name = $request->emp_name;
        $number = $request->store_phone;
        $city = $request->city;
        $email = $request->email;
        $range = $request->del_range;
        $password = $request->password;
        $address = $request->address;
        $share =$request->share;
        $admin_approval = 0;
        $discount = str_replace("%",'', $share);
        $addres = str_replace(" ", "+", $address);
        $address1 = str_replace("-", "+", $addres);
        $checkmap = DB::table('map_API')
                  ->first();
                  
        $chkstorphon = DB::table('store')
                      ->where('phone_number', $number)
                      ->first(); 
         $chkstoremail = DB::table('store')
                      ->where('email', $email)
                      ->first();              
        $checkall = DB::table('store')
                      ->where('email', $email)
                      ->where('phone_number', $number)
                      ->first();
         if($checkall && $checkall->admin_approval == 0){
             	$message = array('status'=>'0', 'message'=>'This Phone Number and Email Are Already Registered With Another Store and waiting for Admin Approval');
	           return $message;
        } 

        elseif($chkstorphon && $chkstorphon->admin_approval == 0){
            	$message = array('status'=>'0', 'message'=>'This Phone Number is Already Registered With Another Store and waiting for Admin Approval');
	           return $message;
        } 
        elseif($chkstoremail && $chkstoremail->admin_approval == 0){
           	$message = array('status'=>'0', 'message'=>'This Email is Already Registered With Another Store and waiting for Admin Approval');
	           return $message;
        } 
         elseif($checkall && $checkall->admin_approval == 1){
             	$message = array('status'=>'0', 'message'=>'This Phone Number and Email Are Already Registered With Another Store.');
	           return $message;
        } 

        elseif($chkstorphon && $chkstorphon->admin_approval == 0){
            	$message = array('status'=>'0', 'message'=>'This Phone Number is Already Registered With Another Store.');
	           return $message;
        } 
        elseif($chkstoremail && $chkstoremail->admin_approval == 0){
           	$message = array('status'=>'0', 'message'=>'This Email is Already Registered With Another Store.');
	           return $message;
        } 
       else{           
       
         $lat = $request->lat;
         $lng = $request->lng;
        if($request->store_doc){
            $store_doc = $request->store_doc;
            $store_doc = str_replace('data:image/png;base64,', '', $store_doc);
            $fileName = date('dmyHis').'store_doc'.'.'.'png';
            $fileName = str_replace(" ", "-", $fileName);
            \File::put(base_path(). '/images/store/documents/' . $fileName, base64_decode($store_doc));
            $store_doc = '/source/images/store/documents/'.$fileName;
            
        }



    	$insert = DB::table('store')
                    ->insertgetid([
                        'store_name'=>$store_name,
                        'employee_name'=>$emp_name,
                        'phone_number'=>$number,
                        'city'=>$city,
                        'email'=>$email,
                        'del_range'=> $range,
                        'password'=>$password,
                        'address'=>$address,
                        'lat'=>$lat,
                        'lng'=>$lng,
                        'admin_share'=>$share,
                        'admin_approval'=>$admin_approval
                        ]);
                        
                        
    if($insert){
          $store = DB::table('store')
                ->where('store_id',$insert)
                ->first();
         $docins =  DB::table('store_doc')
                ->insert(['store_id'=>$insert,
                'document'=>$store_doc
                ]);

        	$message = array('status'=>'1', 'message'=>'Store Registered, please wait for admin approval', 'data'=>$store);
	        return $message;
              }
    	else{
    		$message = array('status'=>'0', 'message'=>'Something went wrong', 'data'=>[]);
	        return $message;
    	}
        
    }
     }
}