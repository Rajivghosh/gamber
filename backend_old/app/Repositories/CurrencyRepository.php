<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Auth\Currency;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;


/**
 * Class CurrencyRepository.
 */
class CurrencyRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Currency::class;
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
            ->first();

        return $user;
    }
}
