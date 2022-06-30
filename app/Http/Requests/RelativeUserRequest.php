<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelativeUserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'login' => 'required|string|unique:relative_users,login',
            'photo' => '',
            'followed' => 'required|boolean',
            'about' => 'required|min:1|max:100',
        ];
  
        switch ($this->getMethod())
        {
          case 'POST':
            return $rules;
          case 'PUT':
            return [
              'relative_user_id' => 'required|integer|exists:relative_users,id', //должен существовать. Можно вот так: unique:games,id,' . $this->route('game'),
              'login' => [
                'required',
                Rule::unique('relative_users')->ignore($this->login, 'login') //должен быть уникальным, за исключением себя же
              ]
            ] + $rules; // и берем все остальные правила
          // case 'PATCH':
          case 'DELETE':
            return [
                'relative_user_id' => 'required|integer|exists:relative_users,id'
            ];
        }
    }
}
