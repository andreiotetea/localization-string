<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 11/3/2022
 * Time: 2:47 PM
 */

namespace App\Services;


use App\Repositories\LanguageRepository;

class LanguageService
{
    /** @var $languageRepository LanguageRepository */
    private $languageRepository;

    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function get(): array
    {
        return $this->languageRepository->get()->toArray();
    }
}