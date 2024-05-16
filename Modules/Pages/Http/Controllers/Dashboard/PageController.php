<?php

namespace Modules\Pages\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Pages\Entities\Page;
use Modules\Pages\Http\Requests\PageRequest;
use Modules\Pages\Repositories\PageRepository;

class PageController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var PageRepository
     */
    private $repository;

    /**
     * PageRepositoryController constructor.
     * @param PageRepository $repository
     */
    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        $pages = $this->repository->all();

        return view('pages::pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create()
    {
        return view('pages::pages.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param PageRequest $request
     * @return RedirectResponse
     */
    public function store(PageRequest $request)
    {
        $page = $this->repository->create($request->all());

        flash(trans('pages::pages.messages.created'))->success();

        return redirect()->route('dashboard.pages.show', $page);
    }

    /**
     * Show the specified resource.
     * @param Page $page
     * @return Factory|View
     */
    public function show(Page $page)
    {
        $page = $this->repository->find($page);

        return view('pages::pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Page $page
     * @return Factory|View
     */
    public function edit(Page $page)
    {
        return view('pages::pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     * @param PageRequest $request
     * @param Page $page
     * @return RedirectResponse
     */
    public function update(PageRequest $request, Page $page)
    {
        $page = $this->repository->update($page, $request->all());

        flash(trans('pages::pages.messages.updated'))->success();

        return redirect()->route('dashboard.pages.show', $page);
    }

    /**
     * Remove the specified resource from storage.
     * @param Page $page
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Page $page)
    {
        $this->repository->delete($page);

        flash(trans('pages::pages.messages.deleted'))->error();

        return redirect()->route('dashboard.pages.index');
    }
}
