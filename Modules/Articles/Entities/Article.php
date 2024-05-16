<?php

namespace Modules\Articles\Entities;

use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use App\Http\Filters\Filterable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Articles\Entities\Helpers\ArticleHelpers;
use Modules\Support\Traits\Selectable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use Translatable,
        Filterable,
        Selectable,
        InteractsWithMedia,
        HasUploader,
        ArticleHelpers,
        HasFactory;

    /**
     * @var array
     */
    public $translatedAttributes = ['name', 'content'];

    /**
     * @var array
     */
    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')
            ->useFallbackUrl('https://ui-avatars.com/api/?name=' . rawurldecode($this->name) . '&bold=true')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(50);

                $this->addMediaConversion('small')
                    ->width(120);

                $this->addMediaConversion('medium')
                    ->width(160);

                $this->addMediaConversion('large')
                    ->width(320);

                $this->addMediaConversion('extra_large')
                    ->width(720);
            });
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Articles\Database\factories\ArticleFactory::new();
    }

}
