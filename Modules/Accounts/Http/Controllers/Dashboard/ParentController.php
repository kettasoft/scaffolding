<?php

namespace Modules\Accounts\Http\Controllers\Dashboard;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Application;
use Modules\Accounts\Entities\ParentModel;
use Modules\Accounts\Http\Requests\ParentRequest;
use Modules\Accounts\Repositories\ParentRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ParentController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * The repository instance.
     *
     * @var ParentRepository
     */
    private $repository;

    /**
     * ParentModelController constructor.
     *
     * @param ParentRepository $repository
     */
    public function __construct(ParentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $parents = $this->repository->all();

        return view('accounts::parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('accounts::parents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ParentRequest $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(ParentRequest $request)
    {
        $parent = $this->repository->create($request->allWithHashedPassword());

        flash(trans('accounts::parents.messages.created'))->success();

        return redirect()->route('dashboard.parents.show', $parent);
    }

    /**
     * Display the specified resource.
     *
     * @param ParentModel $parent
     * @return Application|Factory|View
     */
    public function show(ParentModel $parent)
    {
        $parent = $this->repository->find($parent);

        return view('accounts::parents.show', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ParentModel $parent
     * @return Application|Factory|View
     */
    public function edit(ParentModel $parent)
    {
        $parent = $this->repository->find($parent);

        return view('accounts::parents.edit', compact('parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ParentRequest $request
     * @param ParentModel $parent
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(ParentRequest $request, ParentModel $parent)
    {
        $parent = $this->repository->update($parent, $request->allWithHashedPassword());

        flash(trans('accounts::parents.messages.updated'))->success();

        return redirect()->route('dashboard.parents.show', $parent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ParentModel $parent
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(ParentModel $parent)
    {
        $this->repository->delete($parent);

        flash(trans('accounts::parents.messages.deleted'))->error();

        return redirect()->route('dashboard.parents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ParentModel $parent
     * @return RedirectResponse
     * @throws \Exception
     */
    public function block(ParentModel $parent): RedirectResponse
    {
        $this->repository->block($parent);

        flash(trans('accounts::parents.messages.blocked'))->success();

        return redirect()->route('dashboard.parents.show', $parent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ParentModel $parent
     * @return RedirectResponse
     * @throws \Exception
     */
    public function unblock(ParentModel $parent)
    {
        $this->repository->unblock($parent);

        flash(trans('accounts::parents.messages.unblocked'))->success();

        return redirect()->route('dashboard.parents.show', $parent);
    }
}
