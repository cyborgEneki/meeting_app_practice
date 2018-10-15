<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 15/10/2018
 * Time: 12:23 PM
 */
namespace App\Repositories;

use App\Venue;
use Illuminate\Http\Request;

interface VenueRepositoryInterface
{
    public function allVenues();
    public function showVenue($id);
    public function createVenue(Request $request);
    public function updateVenue(Request $request, Venue $venue);
    public function deleteVenue(Venue $venue);
}
