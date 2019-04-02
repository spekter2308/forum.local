<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

/**
 * Class ThreadFilters
 * @package App
 */
class ThreadFilters extends Filters
{
    protected $filters = ['by'];

    /**
     * Filter the query by a given username
     *
     * @param string $username
     * @return mixed
     */
    protected function by($username)
    {
         /*if (!$username = $this->request->by)
           return $this->builder;*/

        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}