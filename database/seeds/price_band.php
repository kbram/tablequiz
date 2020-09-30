<?php

use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\PriceBand;

class price_band extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_bands')->insert([
            'from'       => '1',
            'to'         => '5',
            'band_type'  => 'participants costs',
            'cost'       => '10.55'
         ]);
         DB::table('price_bands')->insert([
            'from'       => '6',
            'to'         => '10',
            'band_type'  => 'participants costs',
            'cost'       => '15.55'
         ]);
         DB::table('price_bands')->insert([
            'from'       => '11',
            'to'         => '15',
            'band_type'  => 'participants costs',
            'cost'       => '17.55'
         ]);
         DB::table('price_bands')->insert([
            'from'       => '16',
            'to'         => '20',
            'band_type'  => 'participants costs',
            'cost'       => '18.55'
         ]);
         DB::table('price_bands')->insert([
            'from'       => '1',
            'to'         => '10',
            'band_type'  => 'questions costs',
            'cost'       => '5.55'
         ]);
         DB::table('price_bands')->insert([
            'from'       => '11',
            'to'         => '20',
            'band_type'  => 'questions costs',
            'cost'       => '7.55'
         ]);
         DB::table('price_bands')->insert([
            'from'       => '21',
            'to'         => '30',
            'band_type'  => 'questions costs',
            'cost'       => '8.55'
         ]);
         DB::table('price_bands')->insert([
            'from'       => '1',
            'to'         => '3',
            'band_type'  => 'backgrounds costs',
            'cost'       => '3.25'
         ]);
         DB::table('price_bands')->insert([
            'from'       => '4',
            'to'         => '8',
            'band_type'  => 'backgrounds costs',
            'cost'       => '4.25'
         ]);
         DB::table('price_bands')->insert([
            'from'       => '9',
            'to'         => '15',
            'band_type'  => 'backgrounds costs',
            'cost'       => '5.25'
         ]);
    }
}
