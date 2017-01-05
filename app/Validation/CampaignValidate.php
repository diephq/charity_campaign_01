<?php
namespace App\Validation;

use Illuminate\Support\Facades\Validator;
use Request;

class CampaignValidate extends Validator
{
    public function campaign($attribute, $value, $parameters, $validator)
    {
        if (count($value) == 3) {
            $goals = $value['goal'];
            $categories = $value['name'];

            foreach ($categories as $key => $category) {

                if ((!$category && $goals[$key] > 0) || ($category && !$goals[$key])) {

                    return false;
                }
            }

            return true;
        }

        return false;
    }
}
