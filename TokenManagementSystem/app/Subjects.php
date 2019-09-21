<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{

	protected $fillable = [ 
        'subject_id', 'name', 'year', 'branch',
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

    public function questions(){

        return $this->hasMany(Questions::class, $foreignKey='subject_id', $localKey='subject_id');
    }

    public function submissions(){

        return $this->hasMany(Submissions::class, $foreignKey='subject_id', $localKey='subject_id');
    }

    public static function getSubjectId($subName, $year, $branch){

        return Subjects::select('subject_id')->where('name',$subName)->where('year',$year)->where('branch',$branch)->first()['subject_id'];
    }

}
