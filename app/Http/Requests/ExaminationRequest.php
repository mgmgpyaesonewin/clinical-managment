<?php

namespace App\Http\Requests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ExaminationRequest extends FormRequest
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
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
    // public function withValidator($validator)
    // {
    //     dd($validator->errors);
    // }
    protected function getValidatorInstance()
    {
        $data = $this->all();
        $data['type']='x';
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
    
    public function rules()
    {
        return[
               'term'=>'required',
               'value'=>'required',
               'doctor_id'=>'required',
               'type'=>'required',
               'consultation_id'=>'required',
               'code'=>'required',
               'type'=>'required',
               'snomed_ct'=>'required',
               'doctor_id'=>'required'
            ];
    }
}
