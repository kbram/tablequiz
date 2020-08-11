<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PriceBand;
class PriceBandsController extends Controller
{
    public function index(){
         $questionCosts = PriceBand::where('band_type','=','questions costs')->get();
         $backgroundCosts = PriceBand::where('band_type','=','backgrounds costs')->get();
         $participantCosts = PriceBand::where('band_type','=','participants costs')->get();
         
         return view('admin.financials',compact('questionCosts','backgroundCosts','participantCosts'));
    }
}
