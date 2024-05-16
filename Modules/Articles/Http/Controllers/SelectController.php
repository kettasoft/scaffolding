<?php

namespace Modules\Articles\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Articles\Entities\Article;
use Modules\Articles\Transformers\ArticleSelectResource;
use Modules\Levels\Http\Filters\SelectFilter;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Levels\Http\Filters\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function articles(SelectFilter $filter)
    {
        $articles = Article::filter($filter)->get();

        return ArticleSelectResource::collection($articles);
    }

    /**
     * Display a single of the resource.
     *
     * @param Article $article
     * @return ArticleSelectResource
     */
    public function article(Article $article)
    {
        return new ArticleSelectResource($article);
    }
}
