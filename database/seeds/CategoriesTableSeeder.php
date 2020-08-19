<?php

use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quiz_categories')->insert([
           'category_name'         => 'Music' ,  
           'category_slug'         => 'music'

        ]);
        DB::table('quiz_categories')->insert([
            'category_name'           => 'Sports' ,  
              'category_slug'         => 'sports'
 
         ]);
         DB::table('quiz_categories')->insert([
            'category_name'           => 'Geography' ,  
              'category_slug'         => 'geography'
 
         ]);
         DB::table('quiz_categories')->insert([
            'category_name'  => 'History' ,  
              'category_slug'         => 'history'
 
         ]);
         DB::table('quiz_categories')->insert([
            'category_name'           => 'Politics' ,  
              'category_slug'         => 'politics'
 
         ]);
         DB::table('quiz_categories')->insert([
            'category_name'  => 'Popular Culture' ,  
              'category_slug'         => 'popular-culture'
        ]);
    }
}
