<?php

namespace Modules\Pages\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Page;
use Modules\Pages\Repositories\PageRepository;
use Modules\Pages\Transformers\PageResource;
use Modules\Support\Traits\ApiTrait;

class PageController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * @var PageRepository
     */
    private $repository;

    /**
     * CountryController constructor.
     *
     * @param PageRepository $repository
     */
    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the countries.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $pages = $this->repository->all();

        if (count($pages) > 0) {
            $data = PageResource::collection($pages)->response()->getData(true);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }

    /**
     * Display the specified country.
     *
     * @param Page $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Page $page): \Illuminate\Http\JsonResponse
    {
        if ($page) {
            $page = $this->repository->find($page);

            $data = new PageResource($page);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }
}
