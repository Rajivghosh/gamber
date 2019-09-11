<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Circle;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;


/**
 * Class CircleRepository.
 */
class CircleRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Circle::class;
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
                'circle_code'       => $data['circle_code'],
                'target_achive'  => $data['target_achive'],
                'round_set'    => $data['round_set'],
                'p_round'     => $data['p_round'],
                'no_of_member' => $data['no_of_member'],
                'reason_for_circle' => $data['reason_for_circle'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'estimate_round' => $data['estimate_round'],
                'status' => $data['status'],
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
     *
     * @return array|bool
     * @throws GeneralException
     */
    public function findByCondition(array $where)
    {
        $user = $this->model
            ->where($where)
            ->orderBy('id','DESC')
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
