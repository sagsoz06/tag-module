<?php

namespace Modules\Tag\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Translatable;

    protected $table = 'tag__tags';
    public $translatedAttributes = ['slug', 'name'];
    protected $fillable = ['namespace', 'slug', 'name'];

    public function getModuleAttribute()
    {
        $namespace =  @array_values(explode('/', $this->getAttribute('namespace')))[1];
        return trans("$namespace::".str_plural($namespace).".title.".str_plural($namespace));
    }

    public function tagged()
    {
        return $this->belongsToMany(Tag::class, 'tag__tagged', 'tag_id');
    }

    public function getUrlAttribute()
    {
        switch ($this->namespace)
        {
            case 'asgardcms/blog':
                return route('blog.tag', [$this->slug]);
                break;
            case 'asgardcms/news':
                return route('news.tag', [$this->slug]);
                break;
            case 'asgardcms/page':
                return route('page.tag', [$this->slug]);
                break;
            default:
                return null;
        }
    }
}
