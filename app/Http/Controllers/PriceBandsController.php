<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PriceBand;
use Validator;
class PriceBandsController extends Controller
{
    public function index(){
         $questionCosts = PriceBand::where('band_type','=','questions costs')->get();
         $backgroundCosts = PriceBand::where('band_type','=','backgrounds costs')->get();
         $participantCosts = PriceBand::where('band_type','=','participants costs')->get();

         return view('admin.financials',compact('questionCosts','backgroundCosts','participantCosts'));
    }

    
  public function update(Request $request)
  {   
      
    $validator = Validator::make(
      $request->all(),
      [
        'get_from'       => 'required',
        'get_to'         => 'required',
        'get_cost'       => 'required',

      ]
    );
    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }

    

    $priceBand = PriceBand::find($request->id);

    $priceBand->from     =  $request->get_from;
    $priceBand->to       =  $request->get_to;
    $priceBand->cost     =  $request->get_cost;
    

    $priceBand->save();

    return back()->with('success', 'Price Band update Success');
  }


}
