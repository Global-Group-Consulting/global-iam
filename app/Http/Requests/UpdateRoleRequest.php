<?php
  
  namespace App\Http\Requests;
  
  use Illuminate\Foundation\Http\FormRequest;
  
  class UpdateRoleRequest extends FormRequest {
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
        "code"          => [
          "required",
          "unique:App\Models\Role,code," . $this->route()->parameter("role")->_id,
          "regex:/^[a-z_]{2,}$/i"
        ],
        "description"   => "required",
        "permissions.*" => "nullable|exists:App\Models\Permission,code"
      ];
    }
  }
