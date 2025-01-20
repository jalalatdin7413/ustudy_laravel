<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'name'
    ];

    protected function casts(): array 
    {
        return [
            'created_at' => 'datetime',
            'updated_at' =>'datetime'
        ];
    }

    /**
     * Summary of tags
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    
    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    } 

    /**
     * Summary of videos
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */

    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'taggable');
    } 
}

