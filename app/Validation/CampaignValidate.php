<?php
namespace App\Validation;

use Illuminate\Support\Facades\Validator;
use Request;

class CampaignValidate extends Validator
{
    public function campaign($attribute, $value, $parameters, $validator)
    {
        if (count($value) == 2) {
            $goals = $value['goal'];
            $categoryIds = $value['category'];

            foreach ($goals as $key => $goal) {

                if (!array_key_exists($key, $categoryIds) && $goal) {
                    return false;
                }

                if (array_key_exists($key, $categoryIds) && ($key == $categoryIds[$key]
                        && !$goal || $key != $categoryIds[$key])
                ) {

                    return false;
                }
            }

            return true;
        }

        return false;
    }
}
