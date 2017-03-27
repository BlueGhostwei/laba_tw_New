<?php

namespace App\Models;

use Eloquent;

/**
 * 权限点
 *
 * Class AclResource
 * @package App\Models
 *
 * @author  fengqi <lyf362345@gmail.com>
 * @copyright Copyright (c) 2015 udpower.cn all rights reserved.
 */
class AclResource extends Eloquent
{
    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'acl_resource';

    /**
     * 不自动维护更新创建时间
     *
     * @var boolean

    public $timestamps = false;
     *
     * /**
     * 不能被批量赋值的属性, 与 $fillable 只能选其一
     *
     * @var array
     */
    protected $fillable = ['name', 'action'];

    public $AclResource = [
        '用户中心' => [
            '查看我的资料' => ['UserController@my'],
            '查看用户列表' => 'UserController@index',
            '创建用户' => ['UserController@create', 'UserController@store', 'UserController@show'],
            '修改用户' => ['UserController@edit', 'UserController@update'],
            '删除用户' => 'UserController@destroy',
            '锁定用户' => 'UserController@lock',
            '查看已删除用户列表' => 'UserController@trash',
            '恢复已删除用户' => 'UserController@restore',
        ],
        '网络媒体' => [
            '发布新闻任务' => 'MediaController@index',
            
        ],
        '会员中心'=>[
            '会员信息'=>'UserController@user_info',
            '查看个人订单列表'=>'MediaController@Member_order',

        ],
        '平台管理' => [
            '查看媒体分类' => ['CategoryController@index'],
            '创建修改媒体分类' => ['CategoryController@create_category', 'CategoryController@media_save', 'MediaController@media_save'],
            '查看媒体列表' => ['MediaController@media_List'],
            '新增用户'=>'UserController@addUser',
            '用户管理'=>'UserController@userManage',
            '删除媒体分类' => ['CategoryController@cate_dele']
        ],
        '权限配置' => [
            '查看角色列表' => 'AclRoleController@index',
            '创建用户角色' => 'AclUserController@user_role',
            '修改角色权限' => ['AclRoleController@edit', 'AclRoleController@update'],
        ],
        '系统编辑' => [
            '查看系统日志' => 'SystemController@logs',
            '查看操作记录' => 'SystemController@action',
            '查看登录记录' => 'SystemController@loginHistory',
        ]


    ];

    public function getResource()
    {
        return $this->AclResource;
    }
}
