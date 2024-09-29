<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class SettingController
{
    public function __invoke(Request $request)
    {
        return view('setting.index');
    }
}
