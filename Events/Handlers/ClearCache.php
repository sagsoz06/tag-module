<?php namespace Modules\Tag\Events\Handlers;


use Illuminate\Events\Dispatcher;
use Modules\Tag\Repositories\TagRepository;

class ClearCache
{
    public function clear()
    {
        return app(TagRepository::class)->clearCache();
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen('tag.clearCache', '\Modules\Tag\Events\Handlers\ClearCache@clear');
    }
}