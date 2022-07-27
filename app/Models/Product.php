<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, Searchable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'article',
        'manufacturer',
        'machines',
        'desc',
        'pub_user_id',
        'pub_org_id',
    ];

    /**
     * Получить все вложения товара.
     */
    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachmentable');
    }

    /**
     * Поля по которым будет производиться поиск.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'article' => $this->article
        ];
    }

    public function getUrlCover()
    {
        return $this->getMedia('images')->first()->getUrl('thumb');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        // $this->addMediaConversion('thumb')
        //     ->width(144)
        //     ->height(144)
        //     ->sharpen(1);

        $this->addMediaConversion('thumb')
            ->crop('crop-center', 144, 144)
            ->sharpen(1);

        // $this->addMediaConversion('512')
        //     ->width(512)
        //     ->height(512)
        //     ->sharpen(10);
    }
}
