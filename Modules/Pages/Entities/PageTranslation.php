<?php

namespace Modules\Pages\Entities;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
    ];
}
