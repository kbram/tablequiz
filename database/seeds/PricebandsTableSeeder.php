<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;
use App\Models\PriceBand;

class PricebandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $participants_cost = Str::slug('participants costs', '-');
       $question_cost = Str::slug('questions costs', '-');
       $backgrounds_cost = Str::slug('backgrounds costs', '-');
      
       $priceband = Priceband::where('from','1')->where('to','5')->where('band_type',$participants_cost)->first();
       if($priceband === null){
        DB::table('price_bands')->insert([
            'from'       => '1',
            'to'         => '5',
            'band_type'  => $participants_cost,
            'cost'       => '10.55'
         ]);
        }

        $priceband = Priceband::where('from','6')->where('to','10')->where('band_type',$participants_cost)->first();
       if($priceband === null){
         DB::table('price_bands')->insert([
            'from'       => '6',
            'to'         => '10',
            'band_type'  => $participants_cost,
            'cost'       => '15.55'
         ]);}

         $priceband = Priceband::where('from','11')->where('to','15')->where('band_type',$participants_cost)->first();
       if($priceband === null){
         DB::table('price_bands')->insert([
            'from'       => '11',
            'to'         => '15',
            'band_type'  => $participants_cost,
            'cost'       => '17.55'
         ]);}

         $priceband = Priceband::where('from','16')->where('to','20')->where('band_type',$participants_cost)->first();
       if($priceband === null){
         DB::table('price_bands')->insert([
            'from'       => '16',
            'to'         => '20',
            'band_type'  => $participants_cost,
            'cost'       => '18.55'
         ]);}
         
         $priceband = Priceband::where('from','1')->where('to','10')->where('band_type',$question_cost)->first();
       if($priceband === null){
         DB::table('price_bands')->insert([
            'from'       => '1',
            'to'         => '10',
            'band_type'  => $question_cost,
            'cost'       => '5.55'
         ]);}

         $priceband = Priceband::where('from','11')->where('to','20')->where('band_type',$question_cost)->first();
       if($priceband === null){
         DB::table('price_bands')->insert([
            'from'       => '11',
            'to'         => '20',
            'band_type'  => $question_cost,
            'cost'       => '7.55'
         ]);}

         $priceband = Priceband::where('from','21')->where('to','30')->where('band_type',$question_cost)->first();
       if($priceband === null){
         DB::table('price_bands')->insert([
            'from'       => '21',
            'to'         => '30',
            'band_type'  => $question_cost,
            'cost'       => '8.55'
         ]);}

      $priceband = Priceband::where('from','1')->where('to','3')->where('band_type',$backgrounds_cost)->first();
       if($priceband === null){
         DB::table('price_bands')->insert([
            'from'       => '1',
            'to'         => '3',
            'band_type'  => $backgrounds_cost,
            'cost'       => '3.25'
         ]);}

       $priceband = Priceband::where('from','4')->where('to','8')->where('band_type',$backgrounds_cost)->first();
       if($priceband === null){
         DB::table('price_bands')->insert([
            'from'       => '4',
            'to'         => '8',
            'band_type'  => $backgrounds_cost,
            'cost'       => '4.25'
         ]);}

       $priceband = Priceband::where('from','9')->where('to','15')->where('band_type',$backgrounds_cost)->first();
       if($priceband === null){
         DB::table('price_bands')->insert([
            'from'       => '9',
            'to'         => '15',
            'band_type'  => $backgrounds_cost,
            'cost'       => '5.25'
         ]);}
    }
}
