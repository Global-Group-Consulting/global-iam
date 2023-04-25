<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }
  
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    return [
      "code"        => [
        "required",
        "unique:apps,code",
        "regex:/^[a-z_]{2,}$/i"
      ],
      "description" => "required",
      "emailsFrom"  => "required|email:rfc,dns",
    ];
  }
}
