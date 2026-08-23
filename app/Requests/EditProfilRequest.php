<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfilRequest extends FormRequest
{
public function authorize(): bool
{
  return true;

}
public function rules():array
{
return [
        'name'=> ['required'],
        'email'=>['required','email'],
        'avatar'=>['image|mimes:jpeg,png,jpg,gif|max:2048'],
        'phone'=>['string','required'],
        'old_password' => ['required','string'],
        'password' => ['required','string'],
        'password_confirmation' => ['required','string'],
        'logout_other_devices'=>['boolean'],
];
}
}
