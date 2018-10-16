<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 15/10/2018
 * Time: 12:23 PM
 */
namespace App\Repositories;

use App\Media;
use Illuminate\Http\Request;
interface MediaRepositoryInterface
{
    public function allMedia();
    public function showMedia($id);
    public function createMedia(Request $request);
    public function updateMedia(Request $request, Media $media);
    public function deleteMedia(Media $media);
}
