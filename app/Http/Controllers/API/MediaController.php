<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 15/10/2018
 * Time: 1:18 PM
 */
namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Media;
use App\Repositories\MediaRepositoryInterface;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected $mediaRepository;

    public function __construct(MediaRepositoryInterface $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    public function index()
    {
        $media = $this->mediaRepository->allMedia();
        return $media;
    }

    public function show($id)
    {
        $media = $this->mediaRepository->showMedia($id);
        return $media;
    }

    public function store(MediaRequest $request)
    {
        $media = $this->mediaRepository->createMedia($request);
        return $media;
    }

    public function update(MediaRequest $request, Media $media)
    {
        $this->mediaRepository->updateMedia($request, $media);
        return response()->json(['You have successfully updated this media.'], 200);
    }

    public function destroy(Media $media)
    {
        $this->mediaRepository->deleteMedia($media);
        return response()->json(['You have successfully deleted this media.'],  200);
    }
}