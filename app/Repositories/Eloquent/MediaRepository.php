<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 15/10/2018
 * Time: 12:36 PM
 */
namespace App\Repositories;

use App\Http\Resources\MediaResource;
use App\Media;
use Illuminate\Http\Request;

class MediaRepository implements MediaRepositoryInterface
{
    public function allMedia()
    {
        return MediaResource::collection(Media::all());
    }
    public function showMedia($id)
    {
        $media = Media::findOrFail($id);
        return new MediaResource($media);
    }
    public function createMedia(Request $request)
    {
        $media = Media::create($request->all());
        $media->save();
        return new MediaResource($media);
    }
    public function updateMedia(Request $request, Media $media)
    {
        $media = $media->update($request->all());
        return new MediaResource($media);
    }

    /**
     * @param Media $media
     * @return bool|null
     * @throws \Exception
     */
    public function deleteMedia(Media $media)
    {
        return $media->delete($media);
    }
}