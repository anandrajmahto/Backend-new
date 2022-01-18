<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class Minimum_Max_OrderController extends Controller
{
    
    public function amountupdate(Request $request)
    {
        $title = "Home";
        $min_max_id = $request->min_max_id;
        $min_value = $request->min_value;
         $max_value = $request->max_value;
        
        $this->validate(
            $request,
                [
                    
                    'min_value'=>'required',
                    'max_value'=>'required',
                ],
                [
                    
                    'min_value.required'=>'Min Value Required',
                    'max_value.required'=>'Max Value Required',

                ]
        );
        
    	 $insert = DB::table('minimum_maximum_order_value')
    	            
                    ->update([
                        'min_value'=>$min_value,
                         'max_value'=>$max_value,
                        ]);
     
         return redirect()->back()->withSuccess('Updated Successfully');

    }
    

}