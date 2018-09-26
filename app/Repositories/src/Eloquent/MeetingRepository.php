<?php

namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 26/09/2018
 * Time: 10:57 PM
 */

use App\Meeting;
use App\Repositories\MeetingRepositoryInterface;
use App\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class MeetingRepository extends BaseRepository implements MeetingRepositoryInterface
{
    protected $model;

    public function __construct(Meeting $meeting)
    {
        $this->model = $meeting;
    }

    public function createMeeting($request)
    {
        return $this->model->create($request);
    }
}