<?php

namespace App\Models;

use App\Models\Traits\HasComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasComment;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'content',
        'view',
        'shared',
        'recommended',
        'create_at',
        'updated_at'
   ];

   #[\Override()]
   protected function casts(): array
   {
     return [
        'recommended' => 'bool',
     ];
   }

   /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   

   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class, 'user_id', 'id');
   }

   
     public function tags(): BelongsToMany
     {
        return $this->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id');
     }
}
