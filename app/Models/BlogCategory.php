<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 * @package App\Models
 *
 * @property-read string   $parentTitle
 */
class BlogCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description'
    ];

    const ROOT = 1;

    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Аксессор
     *
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string
     */
    public function getParentTitleAttribute()
    {
        return $title = $this->parentCategory()->title ?? ($this->isRoot() ? 'Корень' : '???');
    }

    /**
     * Проверяет, явл. par_cat корнем
     *
     * @return bool
     */
    protected function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }
}
