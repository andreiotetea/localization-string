<?php

namespace App\Services;

use App\Repositories\LanguageRepositoryInterface;

class LanguageService
{
    private LanguageRepositoryInterface $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function get(): array
    {
        return $this->languageRepository->get()->toArray();
    }
}
