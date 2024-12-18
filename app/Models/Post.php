<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'description',
        'view',
        'shared',
        'recommended',
        'create_at',
        'updated_at'
   ];

   protected function casts(): array
   {
     return [
        'recommended' => 'bool',
     ];
   }
}
