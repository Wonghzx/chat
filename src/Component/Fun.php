<?php


namespace Chat\Component;


class Fun
{
    use TigerBalm;

    /**
     * PHP 7.2 替换 each
     * @author wong ([842687571@qq.com])
     * @copyright Copyright (c)
     * @return array|bool
     */
    public function fun_adm_each(&$array)
    {
        $res = [];
        $key = key($array);
        if ($key !== null) {
            next($array);
            $res[1] = $res['value'] = $array[$key];
            $res[0] = $res['key'] = $key;
        } else {
            $res = false;
        }
        return $res;

    }
}