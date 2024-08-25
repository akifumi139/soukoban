<?php

namespace App\Fakers;

use Faker\Provider\Base;

class ModelNumberProvider extends Base
{
    public function modelNumber()
    {
        $prefix = $this->generator->lexify('MODEL-???');
        $suffix = $this->generator->numerify('###');
        return $prefix . '-' . $suffix;
    }
}
