<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'type', 'parent_id'];

    use HasTranslations;
}
