<?php

namespace Modules\Articles\Entities;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
    ];
}
