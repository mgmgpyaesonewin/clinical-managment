<?php


namespace App\Http\Requests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class InvestigationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
        $this->getInputSource()->replace($data);
        // dd($this->all());
        return parent::getValidatorInstance();
    }
    public function rules()
    {
        return['term'=>'required',
               'value'=>'required',
               'doctor_id'=>'required']
    }
}
