<?php

namespace App\Providers;

use App\Repositories\LanguageRepository;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\TranslationRepository;
use App\Repositories\TranslationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TranslationRepositoryInterface::class, TranslationRepository::class);
        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
