<?php

namespace Modules\Articles\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Modules\Articles\Entities\Article;
use Modules\Articles\Repositories\ArticleRepository;
use Modules\Articles\Transformers\ArticleResource;
use Modules\Support\Traits\ApiTrait;

class ArticleController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * CountryController constructor.
     *
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
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
        $articles = $this->repository->all();

        if (count($articles) > 0) {
            $data = ArticleResource::collection($articles)->response()->getData(true);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }

    /**
     * Display the specified country.
     *
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Article $article): \Illuminate\Http\JsonResponse
    {
        if ($article) {
            $article = $this->repository->find($article);

            $data = new ArticleResource($article);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }
}
