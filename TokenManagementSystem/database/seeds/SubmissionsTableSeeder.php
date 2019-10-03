<?php

use Illuminate\Database\Seeder;
use App\Subjects;
use App\Submissions;
use App\Teachers;

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
     $makeNo=10;
     $initCount= Submissions::all()->count();
     for($i=$initCount+1;$i<=$initCount + $makeNo;$i++){
            //  $year = ['FE','SE','TE','BE'][rand(0,3)];
            
            // //get subjects by year
            // $subs=Subjects::where('year',$year)->get();
            // //get branches and select a random branch
            // $branches=$subs->groupBy('branch')->keys();
            // $branch=$branches[rand(0,count($branches)-1)];
            
            // $subs=$subs->where('branch',$branch);
            // $num = intval($faker->unique()->numberBetween($min=0,$max=(count($subs)-1)));
            // $sub= $subs[$num];
            $subject_id = $faker->unique()->numberBetween($min=1,$max=75);
            $subject= Subjects::where('id',$subject_id)->first();
            $teachers= Teachers::all()->count();
            Submissions::create ([ 
                            'id'=> $i,
                            'subject_id'=>$subject_id,
                            'year'=>$subject->year,
                            'branch'=>$subject->branch,
                            'type'=>'quiz',
                            'created_at'=>now(),
                            'updated_at'=>now(),
                            'teacher_id'=>$faker->numberBetween($min=1,$max=$teachers),
                            'submission_date'=>now()->toDateString(),
                            'start_time'=>now()->toTimeString(),
                            'end_time'=>'23:59:59',
                            'venue'=>'111',
                            'status'=>0,      
                        ]);
        }
    }
}
