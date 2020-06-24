<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 * @package App\Models
 *
 * @property-read BlogCategory $parentCategory
 * @property-read string $parentTitle
 */
class BlogCategory extends Model
{
    use SoftDeletes;

    /**
     * Roots id
     */
    const ROOT = 1;

    protected $fillable
        = [
        'title',
        'slug',
        'parent_id',
        'description',
        ];

    /** Get parents category of category
     *
     * @return BlogCategory
     */
    public function parentCategory(){

        $parentCat = $this->belongsTo(BlogCategory::class,'parent_id','id');

        return $parentCat;

    }

    /**
     * Accessory example (Accessor)
     *
     * @url https://laravel.com/docs/5.8/eloquent-mutators
     * @return string
     */
    public function getParentTitleAttribute()
    {

        $title = $this->parentCategory->title
           ?? ($this->isRoot()
           ? 'Root'
           : '???');

       return $title;
    }

    /**
     * whether the current object is root
     *
     * @return bool
     */
    public function isRoot(){
        return $this->id === BlogCategory::ROOT;
    }

    /**
     *   Accessors Exemple
     * @param string $valueFormObject
     * @return bool|false|string|string[]|null
     *
     */
    public function getTitleAttribute($valueFormObject){
        return mb_strtoupper($valueFormObject);
    }

    /**
     * Mutators example
     * @param string $incomingValue
     */
    public function setTitleAttribute($incomingValue){
        $this->attributes['title'] = mb_strtolower($incomingValue);
    }
}
