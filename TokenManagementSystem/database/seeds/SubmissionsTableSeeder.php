<?php

use Illuminate\Database\Seeder;
use App\Subjects;
use App\Submissions;

class SubmissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $faker= \Faker\Factory::create(); 
     $makeNo=5;

     for($i=1;$i<=$makeNo;$i++){
             $year = ['FE','SE','TE','BE'][rand(0,3)];
            
            //get subjects by year
            $subs=Subjects::where('year',$year)->get();
            //get branches and select a random branch
            $branches=$subs->groupBy('branch')->keys();
            $branch=$branches[rand(0,count($branches)-1)];
            
            $subs=$subs->where('branch',$branch);
            $num = intval($faker->unique()->numberBetween($min=0,$max=(count($subs)-1)));
            $sub= $subs[$num];

            Submissions::create ([
                            'subject_id'=> $sub['subject_id'], 
                            'submission_id'=> $i,
                            'subject_id'=>$sub['subject_id'],
                            'year'=>$year,
                            'branch'=>$branch,
                            'type'=>'quiz'
                                    
                        ]);
        }
    }
}
