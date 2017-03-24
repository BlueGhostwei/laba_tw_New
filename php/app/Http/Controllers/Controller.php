<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Config;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @param $mobile
     * @return bool
     */
    public function isMobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
    }
    /**
     * @param int $len
     * @return string
     */
    public function get_random($len = 2)
    {
        //range 是将10到99列成一个数组
        $numbers = range(10, 99);
        //shuffle 将数组顺序随即打乱
        shuffle($numbers);
        //取值起始位置随机
        $start = mt_rand(1, 10);
        //取从指定定位置开始的若干数
        $result = array_slice($numbers, $start, $len);
        $random = "";
        for ($i = 0; $i < $len; $i++) {
            $random = $random . $result[$i];
        }
        return $random;
    }

    /**
     * @param $member_id
     * @return string
     * 生成订单号
     */
    public function makePaySn($member_id) {
        return mt_rand(10,99)
            . sprintf('%010d',time() - 946656000)
            . sprintf('%03d', (float) microtime() * 1000)
            . sprintf('%03d', (int) $member_id % 1000);
    }

    /**
     * @param $length
     * @return null|string
     * 输入对应长度返回对应随机字符串
     */
    public function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;
        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }
    /**
     *分类获取，id排序规则（从小到大,中间用逗号隔开）
     * 输入表名，与查询字段
     * $data格式为‘参数1，参数2，参数3’
     * 查询格式设定，
     */
    public function joint_sql($table,$set_data ,$data,$sel_type=null){
        if($set_data==null){
            $sql='SELECT * FROM ';
        }else{
            $sql='SELECT '.$set_data.' FROM '.$table.' WHERE ';
        }
        foreach ($data as $k=>$v){
            switch ($k){
               case 0;
                   $sql=$this->get_part($sql,'network',$v);
                break;
               case '1';
                   $sql=$this->get_part($sql,'Entrance_level',$v);
                break;
                case '2';
                    $sql=$this->get_part($sql,'Entrance_form',$v);
                    break;
                case '3';
                    $sql=$this->get_part($sql,'coverage',$v);
                    break;
                case '4';
                    $sql=$this->get_part($sql,'channel',$v);
                    break;
                case '5';
                   if($v !='-1'){
                       $sql =$sql.Config::get('price')[$v]['sql'] ;
                   }
                    break;
          }
        }
        $sql=rtrim(trim($sql),"AND");
        $sql2='SELECT '.$set_data.' FROM '.$table.' WHERE ';
        if(trim($sql)==trim($sql2)){
           $sql='SELECT '.$set_data.' FROM '.$table.' ORDER BY id DESC';
        }
        return $sql;
    }
    protected function get_part($sql,$set_data,$id){
        $rst=explode(',',$id);
        if(!empty($rst)){
            foreach ($rst as $ky=>$rv){
               if($rv!=="-1"){
                   $sql=$sql." instr(concat(',',$set_data,','),',$rv,')<>0 AND ";
               }
            }
        }
        return $sql;
    }

}
