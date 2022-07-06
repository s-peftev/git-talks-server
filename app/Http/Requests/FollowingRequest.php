<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowingRequest extends FormRequest
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
            'follower_id' => 'different:followings,follower_id',
            'followed_id' => 'different:followings,followed_id',
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                        'follower_id' => 'required|integer|exists:users,id', //должен существовать. Можно вот так: unique:games,id,' . $this->route('game'),
                        'followed_id' => 'required|integer|exists:users,id', //должен существовать. Можно вот так: unique:games,id,' . $this->route('game'),
                    ] + $rules; // и берем все остальные правила
            //case 'PATCH':
            case 'DELETE':
                return [
                    'following_id' => 'required|integer|exists:followings,id'
                ];
        }
    }
}
