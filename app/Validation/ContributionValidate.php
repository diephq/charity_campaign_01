<?php
namespace App\Validation;

use Illuminate\Support\Facades\Validator;
use Request;

class ContributionValidate extends Validator
{
    public function amount($attribute, $value, $parameters, $validator)
    {
        foreach ($value as $key => $item) {
            if ($item < 0) {

                return false;
            }
        }

        return true;
    }
}
