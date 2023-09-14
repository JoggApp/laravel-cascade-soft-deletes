<?php

namespace JoggApp\LaravelCascadeSoftDeletes\Traits;

use Illuminate\Support\Collection;

trait CascadeSoftDeletes
{
    public function getCascadeSoftDeletes(): Collection
    {
        if (! property_exists($this, 'cascadeSoftDeletes')) {
            return collect([]);
        }

        return collect($this->cascadeSoftDeletes);
    }
}
