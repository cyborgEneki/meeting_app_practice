<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 6:59 PM
 */

namespace App\Repositories;

use App\Discussion;
use App\Http\Requests\DiscussionRequest;
use Illuminate\Http\Request;

interface DiscussionRepositoryInterface {
    public function allDiscussions();

    public function showDiscussion($id);

    public function createDiscussion(DiscussionRequest $request);

    public function updateDiscussion(DiscussionRequest $request, Discussion $discussion);

    public function deleteDiscussion(Discussion $discussion);
}