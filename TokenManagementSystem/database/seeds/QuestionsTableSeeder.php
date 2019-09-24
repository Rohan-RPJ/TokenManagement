<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Students;
use Faker\Generator as Faker;
use App\Subjects;
use App\Questions;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker= \Faker\Factory::create();
       $makeCount=100;

       for($i=0;$i<$makeCount;$i++){
       		
       		Questions::create(['subject_id'=> $faker->numberBetween($min=1,$max=75),
       		       		       		'question_description'=> $faker->sentence(), 
       		       		       		'option1'=> $faker->word(), 
       		       		       		'option2'=> $faker->word(), 
       		       		       		'option3'=> $faker->word(), 
       		       		       		'option4'=> $faker->word(), 
       		       		       		'correct_option'=> $faker->numberBetween($min=1,$max=4),
       		       		       		'count'=> 0,
       		       		       		'created_at'=>now(),
       		       		       		'updated_at'=>now(),
       		       		       	]);
       }
    }
}
