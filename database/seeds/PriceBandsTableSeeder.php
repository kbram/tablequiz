<?php

use Illuminate\Database\Seeder;
use App\Models\PriceBand;

class PriceBandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if (PriceBand::where('band_type', '=', 'questions cost')->first() === null) {
            $priceBand = PriceBand::create([
                'from'        => '1',
                'to'          => '10',
                'band_type'   => 'questions costs',
                'cost'        => '15.00',
            ]);
            $priceBand = PriceBand::create([
                'from'        => '11',
                'to'          => '29',
                'band_type'   => 'questions costs',
                'cost'        => '24.00',
            ]);
            $priceBand = PriceBand::create([
                'from'        => '30',
                'to'          => '49',               
                'band_type'   => 'questions costs',
                'cost'        => '32.00',
            ]);
        }
    
        if (PriceBand::where('band_type', '=', 'backgrounds costs')->first() === null) {
            $priceBand = PriceBand::create([
                'from'        => '1',
                'to'          => '10',
                'band_type'   => 'backgrounds costs',
                'cost'        => '18.00',
            ]);
            $priceBand = PriceBand::create([
                'from'        => '11',
                'to'          => '29',
                'band_type'   => 'backgrounds costs',
                'cost'        => '29.00',
            ]);
            $priceBand = PriceBand::create([
                'from'        => '30',
                'to'          => '49',
                'band_type'   => 'backgrounds costs',
                'cost'        => '38.00',
            ]);
        }
        if (PriceBand::where('band_type', '=', 'participants costs')->first() === null) {
            $priceBand = PriceBand::create([
                'from'        => '1',
                'to'          => '10',
                'band_type'   => 'participants costs',
                'cost'        => '12.00',
            ]);
       
            $priceBand = PriceBand::create([
                'from'        => '11',
                'to'          => '29',
                'band_type'   => 'participants costs',
                'cost'        => '22.00',
            ]);
       
            $priceBand = PriceBand::create([
                'from'        => '30',
                'to'          => '49',
                'band_type'   => 'participants costs',
                'cost'        => '34.00',
            ]);
        }


    }
}
