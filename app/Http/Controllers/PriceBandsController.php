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

    
  public function update(Request $request,$id)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'from'       => 'required',
        'to'         => 'required',
        'cost'       => 'required',

      ]
    );
    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }

    

    $priceBand = PriceBand::find($id);

    $priceBand->from     =  $request->input('band__from');
    $priceBand->to       =  $request->input('band__to');
    $priceBand->cost     =  $request->input('band__costs');
    

    $priceBand->save();

    return back()->with('success', 'Price Band update Success');
  }


}
