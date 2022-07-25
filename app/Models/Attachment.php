<?php

namespace App\Models;

use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory, Uploadable;

    protected $fillable = [
        'attachmentable',
        'name',
        'type',
        'url',
        'is_published',
    ];

    /**
     * Получить все модели, обладающие attachmentable.
     */
    public function attachmentable()
    {
        return $this->morphTo();
    }
}
