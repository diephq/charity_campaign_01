<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
        $email = $this->request->get('email');
        $rulesGuest = [];
        if (isset($email)) {
            $rulesGuest = [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
            ];
        }

        $rules = [
            'text' => 'required|max:255',
            'campaign_id' => 'required|numeric|exists:campaigns,id',
        ];

        return array_merge($rules, $rulesGuest);
    }
}
