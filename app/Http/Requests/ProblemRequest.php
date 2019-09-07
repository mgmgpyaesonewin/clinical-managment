<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProblemRequest extends FormRequest
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
        return [
            'name'  =>  'required|String',
            'type'=>'required',
            'code'   =>  'required|String',
            'consultation_id'=>  'required',
            'patient_id'=> 'required',
            'status'  =>  'required',
            'start_time'=> 'nullable',
            'end_time'=>'nullable',
        ];
    }
}
