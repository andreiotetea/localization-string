<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 11/3/2022
 * Time: 3:02 PM
 */

namespace App\Repositories;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TranslationRepository
{
    public function get(): Collection
    {
        return Translation::query()->get();
    }
}