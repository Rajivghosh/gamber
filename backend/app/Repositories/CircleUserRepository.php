<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\CircleUser;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;


/**
 * Class CircleUserRepository.
 */
class CircleUserRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CircleUser::class;
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $circleuser = parent::create([
                'user_id'        => $data['user_id'],
                'username'       => $data['username'],
                'mobile_number'  => $data['mobile_number'],
                'circle_code'    => $data['circle_code'],
                'preference'     => $data['preference']
            ]);

            /*
             * Return the circleuser object
             */
            return $circleuser;
        });
    }

    /**
     * @param array $where
     * @param array $input
     *
     * @return array|bool
     * @throws GeneralException
     */
    public function updateByCondition(array $where, array $input)
    {
        $updated = $this->model->where($where)
            ->update($input);
        return $updated;
    }

    /**
     * @param array $where
     *
     * @return array|bool
     * @throws GeneralException
     */
    public function deleteByCondition(array $where)
    {
        $delete = $this->model->where($where)
            ->delete();
        return $delete;
    }

    /**
     * @param array $where
     * @param string $order
     *
     * @return array|bool
     * @throws GeneralException
     */
    public function findByCondition(array $where, $order='DESC')
    {
        $user = $this->model
            ->where($where)
            ->orderBy('preference', $order)
            ->get();

        return $user;
    }


    /**
     * @param array $where
     *
     * @return array|bool
     * @throws GeneralException
     */
    public function findCount(array $where)
    {
        $user = $this->model
            ->where($where)
            ->orderBy('id','DESC')
            ->count();

        return $user;
    }
}
