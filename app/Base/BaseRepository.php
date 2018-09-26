<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 26/09/2018
 * Time: 11:34 PM
 */

namespace App\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}