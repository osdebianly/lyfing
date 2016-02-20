<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteCode extends Model
{
    protected $table = 'ss_invite_code';

    /**
     * 所有邀请码
     * @param $uid
     * @return mixed
     */
    public function getAll($uid)
    {
        $codes = InviteCode::where('user_id', $uid)
            ->select('ss_invite_code.code as code', 'users.email as email')
            ->leftJoin('users', 'ss_invite_code.reg_id', '=', 'users.id')
            ->get();
        return $codes;
    }

    /**
     * 公共邀请码
     * @param $uid
     * @return mixed
     */
    public static function getPublicCode()
    {
        $uid = 7;  //admin id
        $codes = InviteCode::where('user_id', $uid)
            ->select('ss_invite_code.code as code', 'users.email as email')
            ->leftJoin('users', 'ss_invite_code.reg_id', '=', 'users.id')
            ->orderBy('ss_invite_code.created_at', 'desc')
            ->take(20)
            ->get();
        return $codes;
    }

}
