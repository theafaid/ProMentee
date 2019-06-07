<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Field extends Model
{
    public $translatable = ['name'];
    protected $fillable = ['name', 'slug', 'type', 'parent_id'];
    protected $with = ['children'];

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

    /**
     * Check if the field is main field or not
     * @return bool
     */
    public function isParent(){
        return $this->parent_id == null;
    }
}
