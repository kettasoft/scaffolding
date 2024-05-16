<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Countries\Http\Filters\SelectFilter;
use Modules\Pages\Entities\Page;
use Modules\Pages\Transformers\PageSelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function pages(SelectFilter $filter)
    {
        $pages = Page::filter($filter)->get();

        return PageSelectResource::collection($pages);
    }
}
