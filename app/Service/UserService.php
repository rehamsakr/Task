<?php


namespace App\Service;


use App\Constant\ConstantGeneral;
use App\Models\User;

class UserService
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }


    /**
     * List Of Users
     * @param bool $paginate
     * @param array $request
     * @param array $withCount
     * @param array $withRelation
     * @return mixed
     */
    public function getUsersList(bool $paginate = true, array $request = [], array $withCount = [], array $withRelation = [])
    {
        // Posts Query
        $query = $this->mainQuery($request, $withCount, $withRelation);
        // Set Posts Data
        return $paginate
            ? ($query->paginate($request['pagination'] ?? ConstantGeneral::PAGINATION_ITEMS_COUNT))
            : $query->get();
    }


    /**
     * Get User By ID
     * @param int $user_id
     * @return mixed
     */
    public function getUserById(int $user_id)
    {
        return $this->mainQuery()->findOrFail($user_id);
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
            ->when(($request['trashed'] ?? false) == true , function ($q) use ($withCount) {
                $q->onlyTrashed();
            });
    }


}
