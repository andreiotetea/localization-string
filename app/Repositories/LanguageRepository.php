<?php

namespace App\Repositories;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class LanguageRepository implements LanguageRepositoryInterface
{
    public function get(): Collection
    {
        return Language::query()->get();
    }
}
