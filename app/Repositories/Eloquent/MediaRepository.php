<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 15/10/2018
 * Time: 12:36 PM
 */
namespace App\Repositories;

use App\Http\Requests\MediaRequest;
use App\Http\Resources\MediaResource;
use App\Media;
use Illuminate\Http\Request;

class MediaRepository implements MediaRepositoryInterface
{
    public function allMedia()
    {
//        return MediaResource::collection(Media::all());
        return MediaResource::collection(Media::take(10)->get());
    }
    public function showMedia($id)
    {
        $media = Media::findOrFail($id);
        return new MediaResource($media);
    }
    public function createMedia(MediaRequest $request)
    {
        $media = Media::create($request->all());
        return new MediaResource($media);
    }
    public function updateMedia(MediaRequest $request, Media $media)
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