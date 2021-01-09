<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'library',
        'name',
        'content',
        'is_client',
        'is_server',
        'is_menu'
    ];
}
