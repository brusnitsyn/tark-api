<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_job_title',
        'org_id',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function org()
    {
        return $this->hasOne(Org::class, 'id', 'org_id');
    }
}
