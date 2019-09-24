<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Teachers;
use Faker\Generator as Faker;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =  User::where('type','Teacher')->get();
	    $faker= \Faker\Factory::create();
	 	//print_r($users);
	    for ($i=0;$i<count($users);$i++) {
	    	$user=$users[$i];
	    	Teachers::create([
	    			'tName'=> $faker->name, 
	                'tEmail'=>$user['email'],

	            	]
	      	    	);
	    }
	   
    }
}
