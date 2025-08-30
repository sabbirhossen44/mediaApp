<?php

namespace App\Repositories;

use Arafat\LaravelRepository\Repository;
use App\Models\Media;
use Illuminate\Http\Request;

class UserRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        // return Media::class;
    }

    public static function storeByRequest(Request $request): Media
    {
        return self::create([
            //
        ]);
    }

    public static function updateByRequest(Request $request, Media $media): Media
    {
        $media->update([
            //
        ]);
        return $media;
    }
}
