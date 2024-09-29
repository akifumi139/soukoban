<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class AccountStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login_id' => 'required|string|max:24|unique:users',
            'name' => 'required|string|max:24|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:管理者,一般',
        ];
    }

    public function params()
    {
        return [
            'login_id' => $this->login_id,
            'name' => $this->name,
            'password' => $this->password,
            'role' => $this->role,
        ];
    }
}
