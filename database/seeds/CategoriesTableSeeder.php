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
      $slug = Str::slug('Music', '-');
      if(QuizCategory::where('category_slug', '=', $slug)->first() === null) {
      $womanaffair= QuizCategory::create([    
           'category_name'  => 'Music' ,  
           'category_slug'      => $slug

        ]);
      }

      $slug = Str::slug('Sports', '-');
      if(QuizCategory::where('category_slug', '=', $slug)->first() === null) {
      $womanaffair= QuizCategory::create([    
           'category_name'  => 'Sports' ,  
           'category_slug'      => $slug

        ]);
      }

      $slug = Str::slug('Geography', '-');
      if(QuizCategory::where('category_slug', '=', $slug)->first() === null) {
      $womanaffair= QuizCategory::create([    
           'category_name'  => 'Geography',  
           'category_slug'      => $slug

        ]);
      }

      $slug = Str::slug('Technology', '-');
      if(QuizCategory::where('category_slug', '=', $slug)->first() === null) {
      $womanaffair= QuizCategory::create([    
           'category_name'  => 'Technology' ,  
           'category_slug'      => $slug

        ]);
      }

      $slug = Str::slug('History', '-');
      if(QuizCategory::where('category_slug', '=', $slug)->first() === null) {
      $womanaffair= QuizCategory::create([    
           'category_name'  => 'History',  
           'category_slug'      => $slug

        ]);
      }
      $slug = Str::slug('Popular Culture', '-');
      if(QuizCategory::where('category_slug', '=', $slug)->first() === null) {
      $womanaffair= QuizCategory::create([    
           'category_name'  => 'Popular Culture' ,  
           'category_slug'      => $slug

        ]);
      }

      $slug = Str::slug('Politics', '-');
      if(QuizCategory::where('category_slug', '=', $slug)->first() === null) {
      $womanaffair= QuizCategory::create([    
           'category_name'  => 'Politics' ,  
           'category_slug'      => $slug

        ]);
      }
        
    }
}
