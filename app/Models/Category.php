<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category){
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function thumbnail():Attribute
    {
        $url = asset('default.webp');
        if ($this->media && Storage::exists($this->media->src)) {
            $url = Storage::url($this->media->src);
        }
        return Attribute::make(
            get: fn () => $url
        );
    }
}
