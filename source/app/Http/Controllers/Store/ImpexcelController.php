<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\YourExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportProducts;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;


class ImpExcelController extends Controller
{
   public function bulkup(Request $request)
    {
        $title = "Bulk Update Mrp,Price & Stock";
    	$logo = DB::table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
    	$store_email=Session::get('bamaStore');
    	 $store= DB::table('store')
    	 		   ->where('email',$store_email)
    	 		   ->first();
          
    	return view('store.products.bulkupload', compact('title', "logo","store"));
    }
    
        public function import(Request $request)
    {
        $store_id = $request->store_id;
       $this->validate(
            $request,
                [
                    
                    'select_file' => 'required'
                ],
                [
                    'select_file.required' => 'choose a csv file.'
                ]
        );
          $count=0;
            $fp = fopen($_FILES['select_file']['tmp_name'],'r') or die("can't open file");
            while($csv_line = fgetcsv($fp,1024))
            {
                $count++;
                if($count == 1)
                {
                    continue;
                }//keep this if condition if you want to remove the first row
                for($i = 0, $j = count($csv_line); $i < $j; $i++)
                {

                    $insert_csv0 = array();
                    $insert_csv0['id'] = $csv_line[0];
                    $insert_csv0['price'] = $csv_line[1];
                    $insert_csv0['mrp'] = $csv_line[2];
                    
                     $inserted = DB::table('store_products')->where('p_id',$insert_csv0['id'])->where('store_id', $store_id)->update(['price'=>$insert_csv0['price'], 'mrp'=>$insert_csv0['mrp']]);
                }
                $i++;
            }
            fclose($fp) or die("can't close file");
          return back()->with('success', 'Prices Updated successfully.');
            return $data;
   } 
    
 public function importstock(Request $request)
    {
      $store_id = $request->store_id;
       $this->validate(
            $request,
                [
                    
                    'select_file' => 'required'
                ],
                [
                    'select_file.required' => 'choose a csv file.'
                ]
        );
          $count=0;
            $fp = fopen($_FILES['select_file']['tmp_name'],'r') or die("can't open file");
            while($csv_line = fgetcsv($fp,1024))
            {
                $count++;
                if($count == 1)
                {
                    continue;
                }//keep this if condition if you want to remove the first row
                for($i = 0, $j = count($csv_line); $i < $j; $i++)
                {

                    $insert_csv0 = array();
                    $insert_csv0['id'] = $csv_line[0];
                    $insert_csv0['stock'] = $csv_line[1];
                    
                     $inserted = DB::table('store_products')->where('p_id',$insert_csv0['id'])->where('store_id', $store_id)->update(['stock'=>$insert_csv0['stock']]);
                }
                $i++;
            }
            fclose($fp) or die("can't close file");
          return back()->with('success', 'Stocks Updated successfully.');
            return $data;
   }  
    
      

}
