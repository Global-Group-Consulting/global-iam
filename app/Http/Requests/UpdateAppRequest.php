<?php
  
  namespace App\Http\Requests;
  
  use Illuminate\Foundation\Http\FormRequest;
  use Illuminate\Validation\Rule;
  
  class UpdateAppRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return false;
    }*/
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
      return [
        "code"        => [
          "required",
          "unique:App\Models\App,code," . $this->route()->parameter("app")->_id,
          "regex:/^[a-z_]{2,}$/i"
        ],
        "description" => "required",
        "emailsFrom"  => "required|email"
      ];
    }
  }
