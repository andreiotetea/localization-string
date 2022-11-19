<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface TranslationRepositoryInterface
{
    public function get(): Collection;

    public function delete(int $translation_id): mixed;

    public function save(array $data): array;
}
