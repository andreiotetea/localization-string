<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 11/3/2022
 * Time: 3:02 PM
 */

namespace App\Repositories;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class LanguageRepository
{
    public function get(): Collection
    {
        return Language::query()->get();
    }
}