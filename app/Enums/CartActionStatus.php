<?php

declare(strict_types=1);

namespace App\Enums;

enum CartActionStatus: string
{
    case BRING_OUT = '持ち出し';
    case ADD_STOCK = '搬入';
    case DELETE_STOCK = '撤去';
    case GIVEBACK = '返却';
}
