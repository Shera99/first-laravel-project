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
        $title = $this->parentCategory()->title ?? ($this->isRoot() ? 'Корень' : '???');
        return $title;
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

    /**
     * Пример Аксесуара
     *
     * @param $valuFromObject
     * @return bool|false|string|string[]|null
     */
    public function getTitleAttribute($valuFromObject)
    {
        return mb_strtoupper($valuFromObject);
    }

    /**
     * Пример Мутатора
     *
     * @param $incomingValue
     */
    public function setTitleAttribute($incomingValue)
    {
        $this->attributes['title'] = mb_strtolower($incomingValue);
    }
}
