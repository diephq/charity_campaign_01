<?php

namespace App\Http\Requests;

use Request;
use Illuminate\Foundation\Http\FormRequest;

class ContributionRequest extends FormRequest
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
        return [
            'name' => 'max:255',
            'email' => 'email|max:255|unique:users',
            'campaign_id' => 'required|numeric|exists:campaigns,id',
            'amount' => 'required|amount:amount',
        ];
    }

    public function messages()
    {
        return [
            'amount.amount' => trans('campaign.validate.amount'),
        ];
    }
}
