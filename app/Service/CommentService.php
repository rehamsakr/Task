<?php


namespace App\Service;


use App\Constant\ConstantGeneral;
use App\Models\Comment;


class CommentService
{
    protected Comment $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }


    /**
     * List Of Comment
     * @param bool $paginate
     * @param array $request
     * @param array $withRelation
     * @return mixed
     */
    public function getCommentsList(bool $paginate = true, array $request = [], array $withRelation = [])
    {
        // Posts Query
        $query = $this->mainQuery($request, $withRelation);
        // Set Posts Data
        return $paginate
            ? ($query->paginate($request['pagination'] ?? ConstantGeneral::PAGINATION_ITEMS_COUNT))
            : $query->get();
    }


    /**
     * Store Post In DB
     * @param array $data
     * @return mixed
     */
    public function storeComment(array $data)
    {
        return $this->model->create($data);
    }


    /**
     * Get Comment By ID
     * @param int $comment_id
     * @return mixed
     */
    public function getCommentById(int $comment_id)
    {
        return $this->mainQuery()->findOrFail($comment_id);
    }


    /**
     * Update Comment in DB
     * @param int $comment_id
     * @param array $data
     * @return mixed
     */
    public function updateComment(int $comment_id, array $data)
    {
        return $this->model->where('id', $comment_id)->update($data);
    }


    /**
     * Delete Comment From DB
     * @param int $comment_id
     * @return mixed
     */
    public function deleteComment(int $comment_id)
    {
        return $this->model->where('id', $comment_id)->forceDelete();
    }


    /**
     * Main Query Comments
     * @param array $request
     * @param array $withRelation
     * @return mixed
     */
    public function mainQuery(array $request = [], array $withRelation = [])
    {
        return $this->model->latest('id')
            ->when(count($withRelation), function ($q) use ($withRelation) {
                $q->with($withRelation);
            })
            ->when(isset($request['post_id']), function ($q) use ($request) {
                $q->where('post_id', $request['post_id']);
            });
    }


}
