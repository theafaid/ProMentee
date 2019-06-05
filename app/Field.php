<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Field extends Model
{
    protected $fillable = ['name', 'slug', 'type', 'parent_id'];

    use HasTranslations;

    /**
     * Get the category parent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo('App\Field', 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(){
        return $this->hasMany('App\Field', 'parent_id', 'id');
    }
}
