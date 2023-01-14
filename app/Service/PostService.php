<?php


namespace App\Service;


use App\Constant\ConstantGeneral;
use App\Models\Post;

class PostService
{
    protected Post $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }


    /**
     * List Of Posts
     * @param bool $paginate
     * @param array $request
     * @param array $withCount
     * @param array $withRelation
     * @return mixed
     */
    public function getPostsList(bool $paginate = true, array $request = [], array $withCount = [], array $withRelation = [])
    {
        // Posts Query
        $query = $this->mainQuery($request, $withCount, $withRelation);
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
    public function storePost(array $data)
    {
        return $this->model->create($data);
    }


    /**
     * Get Post By ID
     * @param int $post_id
     * @param array $request
     * @return mixed
     */
    public function getPostById(int $post_id, array $request = [])
    {
        return $this->mainQuery($request)->findOrFail($post_id);
    }


    /**
     * Update Post in DB
     * @param int $post_id
     * @param array $data
     * @return mixed
     */
    public function updatePost(int $post_id, array $data)
    {
        return $this->getPostById($post_id)->update($data);
    }


    /**
     * Delete Post From DB
     * @param int $post_id
     * @return mixed
     */
    public function deletePost(int $post_id)
    {
        $post = $this->getPostById($post_id, ['trashed' => ConstantGeneral::WITH_TRASHED]);
        if($post->trashed){
            $post->forceDelete();
        }
        return $post->delete();
    }


    /**
     * Main Query Posts
     * @param array $request
     * @param array $withCount
     * @param array $withRelation
     * @return mixed
     */
    public function mainQuery(array $request = [], array $withCount = [], array $withRelation = [])
    {
        return $this->model->latest('id')
            ->when(count($withCount), function ($q) use ($withCount) {
                $q->withCount($withCount);
            })
            ->when(count($withRelation), function ($q) use ($withRelation) {
                $q->with($withRelation);
            })
            ->when((isset($request['trashed']) && in_array($request['trashed'], ConstantGeneral::TRASHED)) , function ($q) use ($request) {
                $request['trashed'] == ConstantGeneral::WITH_TRASHED ? $q->withTrashed() : $q->onlyTrashed();
            });
    }


}
