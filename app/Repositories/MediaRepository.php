<?php

namespace App\Repositories;

use Arafat\LaravelRepository\Repository;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return Media::class;
    }

    public static function storeByRequest(UploadedFile $file, string $path, ?string $type=null): Media
    {
        $path = Storage::disk('public')->put('/' . trim($path, '/'), $file);
        $extension = $file->extension();
        if (! $type) {
            $type = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']) ? 'image' : $extension;
        }
        $media =  self::create([
            'type' => $type,
            'name' => $file->getClientOriginalName(),
            'src' => $path,
            'extension' => $extension
        ]);
        return $media;
    }

    public static function updateByRequest(UploadedFile $file, string $path, ?string $type, Media $media): Media
    {
        $path = Storage::disk('public')->put('/' . trim($path, '/'), $file);
        $extension = $file->extension();
        if (! $type) {
            $type = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']) ? 'image' : $extension;
        }
        if (Storage::exists($media->src)) {
            Storage::delete($media->src);
        }
        $media->update([
            'type' => $type,
            'name' => $file->getClientOriginalName(),
            'src' => $path,
            'extension' => $extension
        ]);
        return $media;
    }
}
