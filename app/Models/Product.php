<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
}
