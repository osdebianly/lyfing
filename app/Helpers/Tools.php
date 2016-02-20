<?php
/**
 * Created by PhpStorm.
 * User: ly
 * Date: 2016/1/23
 * Time: 22:22
 */

namespace App\Helpers;


class Tools
{
    /**
     * 根据流量值自动转换单位输出
     * @param int $value
     * @return int
     */
    public static function flowAutoShow($value = 0)
    {
        $kb = 1024;
        $mb = 1048576;
        $gb = 1073741824;
        if ($value > $gb) {
            return round($value / $gb, 2) . "GB";
        } else if ($value > $mb) {
            return round($value / $mb, 2) . "MB";
        } else if ($value > $kb) {
            return round($value / $kb, 2) . "KB";
        } else {
            return round($value, 2);
        }
    }

    static function toMB($traffic)
    {
        $mb = 1048576;
        return $traffic * $mb;
    }

    static function toGB($traffic)
    {
        $gb = 1048576 * 1024;
        return $traffic * $gb;
    }

    //获取随机字符串
    static function genRandomChar($length = 8)
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $char = '';
        for ($i = 0; $i < $length; $i++) {
            $char .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $char;
    }

    // Unix time to Date Time
    static function toDateTime($time)
    {
        return date('Y-m-d H:i:s', $time);
    }

    /**
     * 获取当前服务器外网ip
     */
    static function getCurrentServerIP()
    {
        $checkURL = "http://ddns.oray.com/checkip";
        $content = file_get_contents($checkURL);
        preg_match("/\d+\.\d+\.\d+\.\d+/", $content, $matchs);
        return $matchs[0];
    }

    /**返回有效的端口，且不能重复
     * @param int $port
     * @return int
     */
    static function getPort($port = 0)
    {
        $ports = \DB::table('users')->lists('port');
        if (empty($port) || $port < 1025 || $port > 60000) {
            $port = rand(1025, 60000);
        } elseif (in_array($port, $ports)) {
            $port = $port + rand(1, 1000);
        }
        return (int)$port;
    }
}