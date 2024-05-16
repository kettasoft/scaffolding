<?php

namespace Modules\Articles\Http\Controllers\Dashboard;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Articles\Entities\Article;
use Modules\Articles\Http\Requests\ArticleRequest;
use Modules\Articles\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->middleware('permission:read_articles')->only(['index']);
        $this->middleware('permission:create_articles')->only(['create', 'store']);
        $this->middleware('permission:update_articles')->only(['edit', 'update']);
        $this->middleware('permission:delete_articles')->only(['destroy']);
        $this->middleware('permission:show_articles')->only(['show']);
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        $articles = $this->repository->all();

        return view('articles::articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create()
    {
        return view('articles::articles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param ArticleRequest $request
     * @return RedirectResponse
     */
    public function store(ArticleRequest $request)
    {
        $article = $this->repository->create($request->all());

        flash(trans('articles::articles.messages.created'))->success();

        return redirect()->route('dashboard.articles.show', $article);
    }

    /**
     * Show the specified resource.
     * @param Article $article
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(Article $article)
    {
        $article = $this->repository->find($article);

        return view('articles::articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Article $article
     * @return Factory|View
     */
    public function edit(Article $article)
    {
        return view('articles::articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     * @param ArticleRequest $request
     * @param Article $article
     * @return RedirectResponse
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article = $this->repository->update($article, $request->all());

        flash(trans('articles::articles.messages.updated'))->success();

        return redirect()->route('dashboard.articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article)
    {
        $this->repository->delete($article);

        flash(trans('articles::articles.messages.deleted'))->error();

        return redirect()->route('dashboard.articles.index');
    }
}
