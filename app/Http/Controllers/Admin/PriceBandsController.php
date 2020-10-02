<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\PriceBand;
use Validator;
class PriceBandsController extends Controller
{
   

    
  public function update(Request $request)
  {  
        if($request->id){


          $validator = Validator::make(
            $request->all(),
            [
            'get_from' => 'required',
            'get_to'   => 'required',
            'get_cost' => 'required',
            
            ]
            );
            if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            }
        $priceBand = PriceBand::find($request->id);
        
        $priceBand->from = $request->get_from;
        $priceBand->to = $request->get_to;
        $priceBand->cost = $request->get_cost;
      
        $priceBand->save();
        }
        
        else{
          $validator = Validator::make(
            $request->all(),
            [
            'new_from' => 'required',
            'new_to'   => 'required',
            'new_cost' => 'required',
            
            ]
            );
            if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            }  


               
        $priceBand = new PriceBand;
        
        $priceBand->from =$request->new_from;
        $priceBand->to = $request->new_to;
        $priceBand->cost = $request->new_cost;
        $priceBand->band_type=Str::slug($request->band_type, '-');
        $priceBand->save();





        }
       
        return back()->with('success', 'Price Band update Success');
  }

  public function destroy(Request $request)
  {  
      $priceBand = PriceBand::find($request->id);
      if ($priceBand->id) {

      $priceBand->delete();
     
      return redirect('admin/financials')->with('success','Delete successfully');
      }

      return back()->with('error', 'Price bands is not deleted');
  }


}
