<?php

use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\QuizCategory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $music=QuizCategory::where('category_name','Music')->first();
      if($music===null){
        DB::table('quiz_categories')->insert([
          'category_name'         => 'Music' ,  
          'category_slug'         => 'music'
        ]);
      } 
      $sports=QuizCategory::where('category_name','Sports')->first();
      if($sports===null){
        DB::table('quiz_categories')->insert([
            'category_name'           => 'Sports' ,  
              'category_slug'         => 'sports'
 
         ]);
      }
      $geography=QuizCategory::where('category_name','Geography')->first();
      if($geography===null){
         DB::table('quiz_categories')->insert([
            'category_name'           => 'Geography' ,  
              'category_slug'         => 'geography'
 
         ]);
        }
        $history=QuizCategory::where('category_name','History')->first();
        if($history===null){
         DB::table('quiz_categories')->insert([
            'category_name'  => 'History' ,  
              'category_slug'         => 'history'
 
         ]);
        }
        $politics=QuizCategory::where('category_name','Politics')->first();
        if($politics===null){
         DB::table('quiz_categories')->insert([
            'category_name'           => 'Politics' ,  
              'category_slug'         => 'politics'
 
         ]);
        }
        $popular=QuizCategory::where('category_name','Popular Culture')->first();
        if($popular===null){
         DB::table('quiz_categories')->insert([
            'category_name'  => 'Popular Culture',
              'category_slug'         => 'popular-culture'
        ]);
      }
      }
        
    }

