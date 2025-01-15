<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'name'                 => 'required|min:3|max:60',
			'email'                => 'required|unique:users',
			'password'             => 'required_unless:id,null|confirmed|min:8|max:60',
		];
    }

    public function messages() : array
	{
		return [
			'name.required'                 => 'Name is required',
			'name.min'                      => 'Name must have at least 3 characters',
			'name.max'                      => 'Name cannot be longer than 60 characters',
			'email.required'                => 'Email is required',
			'email.unique'                  => 'Email must be unique',
			'password.required_unless'      => 'Password is required',
			'password.min'                  => 'Password must have at least 8 characters',
			'password.max'                  => 'Password cannot be longer than 60 characters',
			'password.confirmed'            => 'Password and Password confirm must match each other',
		];
	}

    public function getData() : array
	{
		$data = [
			'name'                 => $this->input('name'),
			'email'                => $this->input('email'),
		];

		if ($this->method() == 'POST') {
			$data['password'] = $this->input('password') ?? null;
		}

		return $data;
	}
}
