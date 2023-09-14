<?php

namespace JoggApp\LaravelCascadeSoftDeletes\Tests\Feature;

use JoggApp\LaravelCascadeSoftDeletes\Models\User;
use JoggApp\LaravelCascadeSoftDeletes\Tests\TestCase;

class CascadeSoftDeletesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::create();
        $this->post = $this->user->posts()->create();
    }

    public function test_soft_deleted_models_cascade()
    {
        $this->assertNotSoftDeleted('users', [
            'id' => $this->user->id,
        ]);

        $this->assertNotSoftDeleted('posts', [
            'id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);

        $this->user->delete();

        $this->assertSoftDeleted('users', [
            'id' => $this->user->id,
        ]);

        $this->assertSoftDeleted('posts', [
            'id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);
    }

    public function test_soft_deleted_models_cascade_on_restore()
    {
        $this->user->delete();

        $this->assertSoftDeleted('users', [
            'id' => $this->user->id,
        ]);

        $this->assertSoftDeleted('posts', [
            'id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);

        $this->user->restore();

        $this->assertNotSoftDeleted('users', [
            'id' => $this->user->id,
        ]);

        $this->assertNotSoftDeleted('posts', [
            'id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);
    }
}
