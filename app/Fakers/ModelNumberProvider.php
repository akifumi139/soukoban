<?php

declare(strict_types=1);

namespace App\Fakers;

use Faker\Provider\Base;

final class ModelNumberProvider extends Base
{
    public function modelNumber()
    {
        $prefix = $this->generator->lexify('MODEL-???');
        $suffix = $this->generator->numerify('###');

        return $prefix.'-'.$suffix;
    }
}
