# Cascading soft deletes for the Laravel PHP Framework

## Implementation

1. Add the `JoggApp\LaravelCascadeSoftDeletes\Traits\CascadeSoftDeletes` trait to parents models.
2. Set `protected $cascadeSoftDeletes` to an array of child relationships for soft deletes to cascade down to.

## Code Samples

```php
<?php

namespace App\Models;

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
```

Now you can delete an `App\Models\User` record, and any associated `App\Models\Post` records will be deleted. If the `App\Models\Post` record implements the `CascadeSoftDeletes` trait as well, it's children will also be deleted and so on.

```php
$user = App\Models\User::find($userId);
$user->delete(); // Soft delete the user, which will also trigger the delete() method on any posts and their children.
```