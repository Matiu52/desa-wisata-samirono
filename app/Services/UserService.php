<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUsersData()
    {
        return [
            'userCount' => User::count(),
            'users' => User::select('id', 'name', 'email', 'role_id', 'created_at')->with('role:id,name')->get(),
        ];
    }
    public function store(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function update(User $user, array $data): User
    {

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update(Arr::only($data, ['name', 'email', 'password', 'role']));
        return $user;
    }
}
