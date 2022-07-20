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
        'ogrn',
        'desc',
        'kpp',
        'email',
        'call',
        'bank_bik',
        'bank_name',
        'bank_ks',
        'bank_rs',
        'type_id',
    ];

    /**
     * Получить все вложения организации.
     */
    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachmentable');
    }

    public function type()
    {
        return $this->hasOne(OrgType::class, 'id', 'type_id');
    }
}
