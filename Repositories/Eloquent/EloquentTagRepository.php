<?php

namespace Modules\Tag\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Tag\Repositories\TagRepository;

class EloquentTagRepository extends EloquentBaseRepository implements TagRepository
{
    /**
     * Get all the tags in the given namespace
     * @param string $namespace
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allForNamespace($namespace)
    {
        return $this->model->with('translations')->where('namespace', $namespace)->get();
    }

    public function findBySlug($slug)
    {
        return $this->model->whereHas('translations', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })->with('translations')->first();
    }
}
