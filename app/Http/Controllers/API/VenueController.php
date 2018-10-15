<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 15/10/2018
 * Time: 1:18 PM
 */
namespace App\Http\Controllers;
use App\Venue;
use App\Repositories\VenueRepositoryInterface;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    protected $venueRepository;

    public function __construct(VenueRepositoryInterface $venueRepository)
    {
        $this->venueRepository = $venueRepository;
    }

    public function index()
    {
        $venue = $this->venueRepository->allVenues();
        return $venue;
    }

    public function show($id)
    {
        $venue = $this->venueRepository->showVenue($id);
        return $venue;
    }

    public function store(Request $request)
    {
        $venue = $this->venueRepository->createVenue($request);
        return $venue;
    }

    public function update(Request $request, Venue $venue)
    {
        $venue = $this->venueRepository->updateVenue($request, $venue);
        return response()->json(['You have successfully updated the venue.'], 200);
    }

    public function destroy(Venue $venue)
    {
        $venue = $this->venueRepository->deleteVenue($venue);
        return $venue;
    }
}