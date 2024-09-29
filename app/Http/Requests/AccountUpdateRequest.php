<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class AccountUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login_id' => 'required|string|max:24|unique:users,login_id,' . $this->account->id,
            'name' => 'required|string|max:24|unique:users,name,'.$this->account->id,
            'password' => 'confirmed',
            'role' => 'required|in:管理者,一般',
        ];
    }

    public function params()
    {
        $params = [
            'login_id' => $this->login_id,
            'name' => $this->name,
            'role' => $this->role,
        ];

        if ($this->password) {
            $params['password'] = $this->password;
        }

        return $params;
    }
}
