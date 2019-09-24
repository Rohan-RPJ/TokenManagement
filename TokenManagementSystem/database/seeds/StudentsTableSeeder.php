<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Students;
use Faker\Generator as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Students:class,10);
        $faker= \Faker\Factory::create();
        $users =  User::where('type','Student')->get();
	    
	    $year = ['FE','SE','TE','BE'];
	    $branch= ['comp','extc','mech','civil','instru'];

	    for ($i=0;$i<count($users);$i++) {
	    	$user=$users[$i];
	    	Students::create([
	    			'sName'=> $faker->name, 
	                'sEmail'=>$user['email'], 
	                'sYear'=> $year[rand(0,count($year)-1)],
	                'sBranch'=>$branch[rand(0,count($branch)-1)], 
	   	            'sRollNo'=>$faker->unique()->numberBetween($min=1,$max=50),
	    	]
	    	);
	    }
	    
	                
    }
}
