<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

    public function all($keys = null)
    {
        // return $this->all();
        $data = parent::all($keys);
        switch ($this->getMethod())
        {
            // case 'PUT':
            // case 'PATCH':
            case 'DELETE':
                $data['date'] = $this->route('day');
        }
        return $data;
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
            'login' => 'required|string|unique:users,login',
            'email'=> 'required|unique:users,email',
            'city'=> 'string',
            'website'=> 'string',
            'photo' => 'string',
            'birthday' => 'required|date',
            'about' => 'required|min:1|max:100',
                ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                        'user_id' => 'required|integer|exists:users,id', //должен существовать. Можно вот так: unique:games,id,' . $this->route('game'),
                        'login' => [
                            'required',
                            Rule::unique('users')->ignore($this->login, 'login') //должен быть уникальным, за исключением себя же
                        ],
                        'email' => [
                            'required',
                            Rule::unique('users')->ignore($this->email, 'email') //должен быть уникальным, за исключением себя же
                        ]
                    ] + $rules; // и берем все остальные правила
            //case 'PATCH':
            case 'DELETE':
                return [
                    'user_id' => 'required|integer|exists:users,id'
                ];
        }
    }
}
