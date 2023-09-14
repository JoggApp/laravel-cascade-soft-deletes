<?php

namespace JoggApp\LaravelCascadeSoftDeletes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JoggApp\LaravelCascadeSoftDeletes\Traits\CascadeSoftDeletes;

class User extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeSoftDeletes = [
        'posts',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
