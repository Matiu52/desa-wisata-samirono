<?php

namespace App\Services\HomeSettings;

use App\Models\HomeSetting;
use App\Models\User;

class SearchService
{
    public function searchSections(string $query)
    {
        $query = trim($query);

        return HomeSetting::when($query, function ($q) use ($query) {
            $q->where('section', 'like', "%$query%")
                ->orWhere('title', 'like', "%$query%");
        })->get();
    }

    public function searchUsers(string $query)
    {
        $query = trim($query);

        return User::with('role')->when($query, function ($q) use ($query) {
            $q->where('name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%");
        })->get();
    }
}