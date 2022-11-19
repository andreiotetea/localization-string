<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface LanguageRepositoryInterface
{
    public function get(): Collection;
}
