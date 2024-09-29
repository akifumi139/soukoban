<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;
use App\Models\User;

final class AccountController
{
    public function index()
    {
        $accounts = User::orderBy('id')->get();

        return view('setting.accounts.index', ['accounts' => $accounts]);
    }

    public function create()
    {
        return view('setting.accounts.create');
    }

    public function store(AccountStoreRequest $request)
    {
        User::create($request->params());

        session()->flash('message', 'アカウントを追加しました。');

        return to_route('settings.accounts.index');
    }

    public function edit(User $account)
    {
        return view('setting.accounts.edit', [
            'account' => $account,
        ]);
    }

    public function update(AccountUpdateRequest $request, User $account)
    {
        $account->update($request->params());

        session()->flash('message', 'アカウントを更新しました。');

        return to_route('settings.accounts.index');
    }

    public function destroy() {}
}
