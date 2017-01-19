<?php
namespace App\Validation;

use Illuminate\Support\Facades\Validator;
use Request;

class ContributionValidate extends Validator
{
    public function amount($attribute, $value, $parameters, $validator)
    {
        $count = 0;
        foreach ($value as $item) {
            if ($item < 0) {

                return false;
            }

            $count += $item;
        }

        if ($count == 0) {

            return false;
        }

        return true;
    }
}
