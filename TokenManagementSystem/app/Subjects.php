<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Submissions;

class Subjects extends Model
{

	protected $fillable = [ 
        'name', 'year', 'branch',
    ];

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function importCsv()
    {
        $file = public_path('csvfiles/Sub.csv');

        $subArr = $this->csvToArray($file);
        //return $subArr;

        for ($i = 0; $i < count($subArr); $i ++)
        {
            Subjects::firstOrCreate($subArr[$i]);
        }

        return 'Job done';    
    }

    public static function getSubjectId($subName, $year, $branch){

        return Subjects::select('id')->where('name',$subName)->where('year',$year)->where('branch',$branch)->first()['id'];
    }

    public static function getTeacherSubjects(){
        $subjects = Subjects::all()->toArray();

        $submissions = Submissions::getTeacherSubmissions();
        $upcoming_submissions = $submissions[0];
        $ongoing_submissions = $submissions[1];
        //$finished_submissions = $submissions[2];

        //dd($subjects);
        for ($up=0; $up < count($upcoming_submissions); $up++) { 
                unset($subjects[$upcoming_submissions[$up]['subject_id'] - 1]);
                //dd($upcoming_submissions[$up]['subject_id']);
        }

        for ($on=0; $on < count($ongoing_submissions); $on++) { 
                unset($subjects[$ongoing_submissions[$on]['subject_id'] - 1]);
        }

        $subjects = array_values($subjects);

        //dd($submissions,$subjects);

        //show subjects to user which are not in ongoing or upcoming submissions
        return $subjects;

    }
    public function questions(){

        return $this->hasMany(Questions::class, $foreignKey='subject_id', $localKey='id');
    }

    public function submissions(){

        return $this->hasMany(Submissions::class, $foreignKey='subject_id', $localKey='id');
    }

}
