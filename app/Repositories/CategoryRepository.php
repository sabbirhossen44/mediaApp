<?php

namespace App\Repositories;

use Arafat\LaravelRepository\Repository;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return Category::class;
    }

    public static function storeByRequest(Request $request): Category
    {
        $thumbnail = null;
        if ($request->hasFile('image')) {
            $thumbnail = MediaRepository::storeByRequest($request->file('image'), 'categories');
        }
        $category = self::create([
            'name' => $request->name,
            'media_id' => $thumbnail?->id ?? null,
        ]);

        return $category;
    }

    public static function updateByRequest(Request $request, Category $category): Category
    {
        $thumbnail = $category->media;
        if ($request->hasFile('image') && $thumbnail) {
            $thumbnail = MediaRepository::updateByRequest($request->file('image'), 'categories', null, $thumbnail);
        }elseif ($request->hasFile('image') && !$thumbnail) {
            $thumbnail = MediaRepository::storeByRequest($request->file('image'), 'categories');
        };
        $category->update([
            'name' => $request->name,
            'media_id' => $thumbnail?->id ?? null,
            'slug' => $request->slug,
        ]);
        return $category;
    }
}