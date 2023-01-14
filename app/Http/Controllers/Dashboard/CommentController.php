<?php

namespace App\Http\Controllers\Dashboard;

use App\Constant\ConstantGeneral;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Service\CommentService;
use App\Service\PostService;
use App\Service\UserService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected CommentService $commentService;

    protected PostService $postService;

    protected UserService $userService;

    public string $view;

    public string $route;

    public function __construct(CommentService $commentService, PostService $postService, UserService $userService)
    {
        $this->commentService = $commentService;
        $this->postService = $postService;
        $this->userService = $userService;
        $this->view = 'dashboard.comments';
        $this->route = 'dashboard.comments.index';
    }

    /**
     * Records List
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Set title page
        $titlePage = __('translation.comments');
        $relation = [
            'user:id,username',
            'post' => function ($q) {
                $q->withTrashed();
            }
        ];
        // Comments List
        $comments = $this->commentService->getCommentsList(true, $request->toArray(), $relation);
        return view("{$this->view}.index", compact('titlePage','comments'));
    }


    /**
     * Display page add new record
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Set title page
        $titlePage = __('crud.add')  . ' ' . __('translation.comment');
        // Posts List
        $posts = $this->postService->getPostsList(false);
        // Users List
        $users = $this->userService->getUsersList(false);
        return view("{$this->view}.create", compact('titlePage', 'posts', 'users'));
    }


    /**
     * Store Record in DB
     * @param StoreCommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $this->commentService->storeComment($request->validated());
        flash('success', __('message.stored'));
        return to_route($this->route);
    }


    /**
     * Display page edit record
     * @param $comment_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($comment_id)
    {
        // Comment Details
        $comment = $this->commentService->getCommentById($comment_id);
        // Posts List
        $posts = $this->postService->getPostsList(false, ['trashed' => ConstantGeneral::WITH_TRASHED]);
        // Users List
        $users = $this->userService->getUsersList(false);
        // Set title page
        $titlePage = __('crud.edit')  . ' ' . __('translation.comment');
        return view("{$this->view}.edit", compact('comment', 'posts', 'users', 'titlePage'));
    }


    /**
     * Update Data in DB
     * @param StoreCommentRequest $request
     * @param $comment_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreCommentRequest $request, $comment_id)
    {
        // Comment Details
        $comment = $this->commentService->getCommentById($comment_id);
        $this->commentService->updateComment($comment_id, $request->validated());
        flash('success', __('message.updated'));
        return to_route($this->route, $comment->post_id);
    }


    /**
     * Delete Comment
     * @param $comment_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($comment_id)
    {
        // Comment Details
        $comment = $this->commentService->getCommentById($comment_id);
        $this->commentService->deleteComment($comment_id);
        flash('success', __('message.deleted'));
        return back();
    }


}
