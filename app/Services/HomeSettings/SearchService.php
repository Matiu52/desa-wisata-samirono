<?php

namespace App\Services\HomeSettings;

use App\Models\User;
use App\Models\Gallery;
use App\Models\HomeSetting;

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

    public function searchGalleries(string $query)
    {
        $query = trim($query);

        return Gallery::when($query, function ($q) use ($query) {
            $q->where('title', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%");
        })
            ->get();
    }

}