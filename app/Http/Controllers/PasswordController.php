<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class PasswordController
{
    public function edit()
    {
        return view('setting.password.edit');
    }

    public function update(PasswordUpdateRequest $request)
    {
        if (! Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
        }

        Auth::user()
            ->update([
                'password' => Hash::make($request->new_password),
            ]);

        session()->flash('message', 'パスワードを更新しました。');

        return to_route('settings.index');
    }
}
