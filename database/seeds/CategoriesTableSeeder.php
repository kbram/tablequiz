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
           'category'  => 'Music' ,  
             'slug'         => 'music'

        ]);
        DB::table('quiz_categories')->insert([
            'category_name'  => 'Sports' ,  
              'slug'         => 'sports'
 
         ]);
         DB::table('quiz_categories')->insert([
            'category_name'  => 'Geography' ,  
              'slug'         => 'geography'
 
         ]);
         DB::table('quiz_categories')->insert([
            'category_name'  => 'History' ,  
              'slug'         => 'history'
 
         ]);
         DB::table('quiz_categories')->insert([
            'category_name'  => 'Politics' ,  
              'slug'         => 'politics'
 
         ]);
         DB::table('quiz_categories')->insert([
            'category_name'  => 'Popular Culture' ,  
              'slug'         => 'popular-culture'
        ]);
    }
}
