<?php

namespace App\Http\Requests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
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
    protected function getValidatorInstance()
    {
        $data = $this->all();
        $data['doctor_id']=auth('api')->user()->id;
        // if($data['date']){
        //     $data['date']=date('Y-m-d',strtotime($data['date']));
        // }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
    
    public function rules()
    {
        return [
            'type'=> 'required',
            'title'  =>  'required|String',
            'comment'   =>  'nullable',
            'address' => 'required|String',
            'patient_id'=>  'required',
            'doctor_id'=>'required',
        ];
    }
}
