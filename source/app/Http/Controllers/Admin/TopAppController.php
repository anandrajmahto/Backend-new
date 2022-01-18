<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Session;

class TopAppController extends Controller
{
    public function adminTopCat(Request $request)
    {
        $title = "Top Category";
    	$category = DB::table('tbl_top_cat')
    	          ->join('categories','tbl_top_cat.cat_id','=','categories.cat_id')
    	          ->get();
        //   var_dump($category);
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();                

    	return view('admin.topcat.index',compact("category", "title","admin","logo"));
    }

    public function adminAddTopCat(Request $request)
    {
        $title = "Add Home Category";
          $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();   
        $topapp = DB::table('tbl_top_cat')
                    ->get();
        if(count($topapp)>0){
        foreach ($topapp as $topapps) {
            $allApps[] = $topapps->cat_id;
            $allPosition[] = $topapps->cat_rank;
        }
        }
        else{
           $allApps[] =0; 
           $allPosition[] = 0;
        }
    	$app = DB::table('categories')
                ->whereNotIn('cat_id', $allApps)
                ->where('level',1)
                // ->orderBy('title', 'ASC')
                ->get();

    	return view('admin.topcat.add', compact("app", "allPosition", "title","admin","logo"));
    }

    public function adminAddNewTopCat(Request $request)
    {
        
        
        $this->validate(
            $request,
                [
                    'cat_id' => 'required',
                    'cat_rank' => 'required',
                ],
                [
                    'cat_id.required' => 'select Category.',
                    'cat_rank.required' => 'select category position.',
                ]
        );

        $app = $request->except('_token');
    	$created_at = Carbon::now();
        $updated_at = Carbon::now();

    	$insertTopApp = DB::table('tbl_top_cat')
    	                   ->insert($app + [
                                'created_at'=>$created_at,
                                'updated_at'=>$updated_at
                            ]);
        
        if($insertTopApp){
            return redirect()->back()->withErrors('Home category added successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }   
    }

    public function adminEditTopCat(Request $request)
    {
        $title = "Edit Home Category";
        
        $topapp = DB::table('tbl_top_cat')
                    ->get();

        $id = $request->id;

        $getApp = DB::table('tbl_top_cat')
                    ->where('id', $id)
                    ->first();

        $getCatId = $getApp->cat_id;
        $getCatRank = $getApp->cat_rank;

        foreach ($topapp as $topapps) {
            if($getCatId != $topapps->cat_id){
                $allApps[] = $topapps->cat_id;
            }
            
            $allPosition[] = $topapps->cat_rank;
        }

        $app = DB::table('categories')
                ->whereNotIn('cat_id', $allApps)
                ->where('level',1)
                ->orderBy('title', 'ASC')
                ->get();
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();  
        return view('admin.topcat.edit', compact("app", "allPosition", "getCatId", "id", "getCatRank", "title","admin","logo"));
    }

    public function adminUpdateTopCat(Request $request)
    {
      
        $this->validate(
            $request,
                [
                    'cat_id' => 'required',
                    'cat_rank' => 'required',
                ],
                [
                    'cat_id.required' => 'select category.',
                    'cat_rank.required' => 'select category position.',
                ]
        );

        $id = $request->id;
        $app = $request->except('_token');
        $updated_at = Carbon::now();

        $updateTopApp = DB::table('tbl_top_cat')
                           ->where('id', $id)
                           ->update($app + [
                                'updated_at'=>$updated_at
                            ]);
        
        if($updateTopApp){
            return redirect()->back()->withSuccess('Home category updated successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        } 
    }

    public function adminTopCatDelete(Request $request)
    {
       
        
        $id = $request->id;
        
        $getPosition = DB::table('tbl_top_cat')
                        ->where('id', $id)
                        ->first();
                        
        $getRank = $getPosition->cat_rank;

        $deleteTopApp = DB::table('tbl_top_cat')
                            ->where('id', $id)
                            ->delete();

        if($deleteTopApp){
            
            $selectApps = DB::table('tbl_top_cat')
                            ->where('cat_rank', '>', $getRank)
                            ->get();
                            
            foreach($selectApps as $selectApp){
                $finalRank = $selectApp->cat_rank - 1;
                
                $updateRank = DB::table('tbl_top_cat')
                                ->where('id', $selectApp->id)
                                ->update([
                                        'cat_rank'=>$finalRank,
                                    ]);
            }
            
            return redirect()->back()->withSuccess('app deleted successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
    }

   
}
