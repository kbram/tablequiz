<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Support\Facades\Route;
use App\Models\PriceBand;

use Config;
class AdminFinancialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(){

        $band_type_configs = [
            'background_band_type' => Config::get('priceband.type.background_band_type'),
            'question_band_type' =>   Config::get('priceband.type.question_band_type'),
            'participant_band_type' => Config::get('priceband.type.participant_band_type'),
        ];
        $questionCosts = PriceBand::where('band_type','=',Config::get('priceband.type.question_band_type'))->get();
        $backgroundCosts = PriceBand::where('band_type','=',Config::get('priceband.type.background_band_type'))->get();
        $participantCosts = PriceBand::where('band_type','=',Config::get('priceband.type.participant_band_type'))->get();

        return view('admin.financials',compact('questionCosts','backgroundCosts','participantCosts','band_type_configs'));
       
   }

    
}
