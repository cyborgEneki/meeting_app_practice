<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 15/10/2018
 * Time: 1:12 PM
 */
namespace App\Repositories;

use App\Http\Requests\VenueRequest;
use App\Http\Resources\VenueResource;
use App\Venue;
use Illuminate\Http\Request;

class VenueRepository implements VenueRepositoryInterface
{
    public function allVenues()
    {
//        return VenueResource::collection(Venue::all());
        return VenueResource::collection(Venue::take(10)->get());
    }

    public function showVenue($id)
    {
        $venue = Venue::findOrFail($id);
        return new VenueResource($venue);
    }

    public function createVenue(VenueRequest $request)
    {
        $venue = Venue::create($request->all());
        return new VenueResource($venue);
    }

    public function updateVenue(VenueRequest $request, Venue $venue)
    {
        $venue = $venue->update($request->all());
        return new VenueResource($venue);
    }

    /**
     * @param Venue $venue
     * @return bool|null
     * @throws \Exception
     */
    public function deleteVenue(Venue $venue)
    {
        return $venue->delete($venue);
    }
}