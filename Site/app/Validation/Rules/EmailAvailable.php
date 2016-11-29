<?php

namespace Site\Validation\Rules;

use Site\Models\User;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule
{
    public function validate($input)
    {
        return User::where('email', $input)->count() === 0;
    }
}
