<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 6:59 PM
 */

namespace App\Repositories;

use App\Discussion;
use Illuminate\Http\Request;

interface DiscussionRepositoryInterface {
    public function allDiscussions();

    public function createDiscussion(Request $request);

    public function updateDiscussion(Request $request, Discussion $discussion);

    public function deleteDiscussion(Discussion $discussion);
}