<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeWhse extends Model
{
    use HasFactory, SoftDeletes;

    // add fillable
    protected $fillable = [];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];
}
