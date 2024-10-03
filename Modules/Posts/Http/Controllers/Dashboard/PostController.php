<?php

namespace Modules\Posts\Http\Controllers\Dashboard;

use Modules\Posts\Entities\Post;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Modules\Posts\Http\Requests\PostRequest;
use Modules\Posts\Repositories\PostRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var PostRepository
     */
    protected PostRepository $repository;

    /**
     * PostController constructor.
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->middleware('permission:read_posts')->only(['index']);
        $this->middleware('permission:create_posts')->only(['create', 'store']);
        $this->middleware('permission:update_posts')->only(['edit', 'update']);
        $this->middleware('permission:delete_posts')->only(['destroy']);
        $this->middleware('permission:show_posts')->only(['show']);
        $this->repository = $repository;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index(): Factory|View
    {
        $posts = $this->repository->all();

        return view('posts::posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create(): Factory|View
    {
        return view('posts::posts.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $post = $this->repository->create($request->all());

        flash(trans('posts::posts.messages.created'))->success();

        return redirect()->route('dashboard.posts.show', $post);
    }

    /**
     * Show the specified resource.
     * @param Post $post
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(Post $post)
    {
        $post = $this->repository->find($post);

        return view('posts::posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Post $post
     * @return Factory|View
     */
    public function edit(Post $post)
    {
        return view('posts::posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     * @param PostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        $post = $this->repository->update($post, $request->all());

        flash(trans('posts::posts.messages.updated'))->success();

        return redirect()->route('dashboard.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post)
    {
        $this->repository->delete($post);

        flash(trans('posts::posts.messages.deleted'))->error();

        return redirect()->route('dashboard.posts.index');
    }
}
