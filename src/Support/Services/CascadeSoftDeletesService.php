<?php

namespace JoggApp\LaravelCascadeSoftDeletes\Support\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use JoggApp\LaravelCascadeSoftDeletes\Traits\CascadeSoftDeletes;

class CascadeSoftDeletesService
{
    public function handle(Collection $models, string $direction)
    {
        $models->each(function ($model) use ($direction) {
            if ($this->shouldCascade($model)) {
                $model->getCascadeSoftDeletes()->each(function ($relation) use ($model, $direction) {
                    $this->{$direction}($model, $relation);
                });
            }
        });
    }

    private function shouldCascade(Model $model): bool
    {
        return in_array(CascadeSoftDeletes::class, class_uses_recursive($model));
    }

    private function canSoftDelete(Model $model): bool
    {
        return in_array(SoftDeletes::class, class_uses_recursive($model));
    }

    private function delete(Model $model, string $relation)
    {
        $model->load($relation)->{$relation}()->get()->each(function (Model $relatedModel) {
            if (! $this->canSoftDelete($relatedModel)) {
                return false;
            }

            $relatedModel->delete();
        });
    }

    private function restore(Model $model, string $relation)
    {
        $model->load($relation)->{$relation}()->onlyTrashed()->get()->each(function (Model $relatedModel) {
            $relatedModel->restore();
        });
    }
}
