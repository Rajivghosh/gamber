<?php

namespace App\Repositories\Auth;

use Carbon\Carbon;
use App\Models\Auth\User;
use Illuminate\Http\UploadedFile;
use App\Models\Auth\SocialAccount;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Image;


/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data, $image = null)
    {
        return DB::transaction(function () use ($data) {

            $email_verification_code = md5(uniqid(mt_rand(), true));
            $mobile_verification_code = mt_rand(1000,9999);
            $user = parent::create([
                'email'                     => $data['email'],
                'username'                  => $data['username'],
                'user_type'                 => 2,
                'password'                  => Hash::make($data['password']),
                'remember_token'            => md5(uniqid(mt_rand(), true)),
                'status'                    => 1
            ]);

            $userinfo = UserInfo::create([
                'user_id'                   => $user->id,
                'first_name'                => $data['first_name'],
                'last_name'                 => $data['last_name'],
                'dob'                       => $date['dob'],
                'contact_no'                => $data['mobile_number'],
                'address'                   => $data['address'],
                'country'                   => $data['country'],
                'state'                     => $data['state'],
                'city'                      => $data['city'],
                'zipcode'                   => $data['zipcode']
            ]);

            /*
             * Return the user object
             */
            return $user;
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
    public function findByCondition(array $where)
    {
        $user = $this->model
            ->where($where)
            ->orderBy('id','DESC')
            ->get();

        return $user;
    }
}
