<?php

namespace Modules\Posts\Entities;

use App\Http\Filters\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Modules\Support\Traits\Selectable;
use Illuminate\Database\Eloquent\Model;
use Scaffolding\Booter\Traits\HasBooter;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Posts\Database\factories\PostFactory;
use Modules\Posts\Entities\Boots\AttachUserIdBooter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Modules\Posts\Entities\Relations\PostRelations;

class Post extends Model implements HasMedia
{
    use HasFactory,
        Filterable,
        Selectable,
        InteractsWithMedia,
        HasUploader,
        PostRelations,
        HasBooter;

    protected $with = [
        'user'
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    protected static $events = [
        'creating' => [
            AttachUserIdBooter::class
        ]
    ];

    /**
     * The user profile image url.
     *
     * @return bool
     */
    public function getAvatar()
    {
        return $this->getFirstMediaUrl('avatars');
    }

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }
}
