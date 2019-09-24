<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        dd($this->request);
        for ($i=1; $i <= $this->request['total']; $i++) { 
            $rules[]
        }
        return [
            'question_description' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'correct_option' => 'required'
        ];
    }
}/*$request['question'.strval($i)],
                'option1' => $request['q'.strval($i).'option1'],
                'option2' => $request['q'.strval($i).'option2'],
                'option3' => $request['q'.strval($i).'option3'],
                'option4' => $request['q'.strval($i).'option4'],
                'correct_option' => (int)$request['q'.strval($i).'correctOption'],*/