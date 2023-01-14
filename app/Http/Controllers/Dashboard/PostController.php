<?php

namespace App\Http\Controllers\Dashboard;

use App\Constant\ConstantGeneral;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Service\PostService;

class PostController extends Controller
{
    protected PostService $postService;

    public string $view;

    public string $route;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        $this->view = 'dashboard.posts';
        $this->route = 'dashboard.posts.index';
    }

    /**
     * Records List
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Set title page
        $titlePage = __('translation.posts');
        // Posts List
        $posts = $this->postService->getPostsList(true, [], ['comments'], ['author:id,username']);
        return view("{$this->view}.index", compact('titlePage', 'posts'));
    }

    /**
     * Records List
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function trashed()
    {
        // Set title page
        $titlePage = __('translation.posts_trashed');
        // Posts List
        $posts = $this->postService->getPostsList(true, ['trashed' => ConstantGeneral::ONLY_TRASHED], ['comments'], ['author:id,username']);
        return view("{$this->view}.index", compact('titlePage', 'posts'));
    }


    /**
     * Display page add new record
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Set title page
        $titlePage = __('crud.add')  . ' ' . __('translation.post');
        return view("{$this->view}.create", compact('titlePage'));
    }


    /**
     * Store Record in DB
     * @param StorePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        $this->postService->storePost($request->validated());
        flash('success', __('message.stored'));
        return to_route($this->route);
    }


    /**
     * Display page edit record
     * @param $post_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($post_id)
    {
        // Post Details
        $post = $this->postService->getPostById($post_id);
        // Set title page
        $titlePage = __('crud.edit')  . ' ' . __('translation.post');
        return view("{$this->view}.edit", compact('post', 'titlePage'));
    }


    /**
     * Update Data in DB
     * @param StorePostRequest $request
     * @param $post_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StorePostRequest $request, $post_id)
    {
        $this->postService->updatePost($post_id, $request->validated());
        flash('success', __('message.updated'));
        return to_route($this->route);
    }


    /**
     * Delete Post
     * @param $post_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($post_id)
    {
        $this->postService->deletePost($post_id);
        flash('success', __('message.deleted'));
        return back();
    }

}
