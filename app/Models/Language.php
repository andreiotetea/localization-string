<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = ['name', 'code'];
    public $timestamps = true;

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class, 'language_id', 'id');
    }
}
