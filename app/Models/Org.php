<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Org extends Model
{
    use HasFactory, Searchable;

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
        'creator_id',
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

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, OrgUser::class, 'org_id', 'id', 'id', 'user_id');
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
            'inn' => $this->inn
        ];
    }
}
