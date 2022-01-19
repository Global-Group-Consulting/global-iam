<?php
  
  namespace App\Http\Requests;
  
  use Illuminate\Foundation\Http\FormRequest;
  use Illuminate\Validation\Rule;
  
  class UpdateUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize() {
      return false;
    }*/
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
      $userId = $this->route()->parameter("user");
      
      return [
        'firstName' => 'required',
        'lastName'  => 'required',
        'email'     => ['required',
          Rule::unique('users')->ignore($userId),
          'email:rfc,dns'
        ],
        'roles.*'   => 'exists:App\Models\Role,code',
        'apps.*'    => 'exists:App\Models\App,code'
      ];
    }
  }
