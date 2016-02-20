<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Helpers\Tools;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'passwd', 'image', 'transfer_enable', 'port', 'method', 'role'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * One to one relation
     */
    public function userRoles()
    {
        return $this->hasOne('App\UserRoles', 'user_id', 'id');
    }

    /**
     * 签到检查
     * @return bool
     */
    public function isAbleToCheckin()
    {
        $last = $this->last_check_in_time;
        $hour = date('H');
        if ($last + $hour * 3600 < time()) {
            return true;
        }
        return false;
    }

    /**
     * 上次签到时间
     * @return mixed
     */
    public function lastCheckInTime()
    {
        return date('Y-m-d H:i:s', $this->attributes['last_check_in_time']);
    }

    /**
     * 获取总流量
     * @return int
     */
    public function getTotalTransfer()
    {
        return Tools::flowAutoShow($this->transfer_enable);
    }

    /**
     * 获取已用流量
     * @return int
     */
    public function getUsedTransfer()
    {
        return Tools::flowAutoShow($this->u + $this->d);
    }

    /**
     * 获取剩余流量
     * @return int
     */
    public function getUnusedTransfer()
    {
        return Tools::flowAutoShow($this->transfer_enable - ($this->u + $this->d));
    }

    /**
     * 流量使用率
     * @return float
     */
    public function trafficUsagePercent()
    {
        try {
            $total = $this->attributes['u'] + $this->attributes['d'];
            $enable = $this->attributes['transfer_enable'];
            $percent = $total / $enable;
            $percent = round($percent, 2);
            $percent = $percent * 100;
            return $percent;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * 更新用户密码
     * @param string $newPassword
     * @return bool
     */
    public function updatePassword($newPassword = '123456')
    {
        $this->password = bcrypt($newPassword);
        return $this->save();
    }

    /**
     * 更新用户密码
     * @param string $passwd
     * @param string $method
     * @param string $port
     * @return bool
     */
    public function updateSS($passwd, $method, $port)
    {
        if (empty($passwd) && empty($method) && empty($port)) {
            return false;
        }
        if ($passwd)
            $this->passwd = trim($passwd);
        if ($method)
            $this->method = trim($method);
        if ($port)
            $this->port = Tools::getPort($port);
        return $this->save();
    }


}
