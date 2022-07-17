<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_id',
        'user_id',
    ];
}
