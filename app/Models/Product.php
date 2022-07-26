<?php

namespace App\Models;

use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable, Uploadable;

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
}
