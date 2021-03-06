<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 * @package App\Models
 *
 * @property \App\Models\BlogCategory   $category
 * @property \App\User                  $user
 * @property string                     $title
 * @property string                     $slug
 * @property string                     $excerpt
 * @property string                     $content_raw
 * @property string                     $content_html
 * @property string                     is_published
 * @property string                     published_at
 */

class BlogPost extends Model
{
    use SoftDeletes;

    protected $table = 'blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
        'user_id',
    ];

    const UNCNOWN_USER = 1;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
