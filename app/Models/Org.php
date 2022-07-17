<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'inn',
        'orgn',
        'desc',
        'kpp',
        'type_id',
    ];

    /**
     * Получить все вложения организации.
     */
    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachmentable');
    }
}
