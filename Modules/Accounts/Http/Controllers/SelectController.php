<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\Provider;
use Modules\Accounts\Entities\User;
use Modules\Accounts\Http\Filters\SelectFilter;
use Modules\Accounts\Transformers\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SelectFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $users = User::filter($filter)->get();

        return SelectResource::collection($users);
    }
}
