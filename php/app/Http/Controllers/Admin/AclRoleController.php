<?php

namespace App\Http\Controllers\Admin;

use App\Models\AclResource;
use App\Models\AclRole;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\AclUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;

/**
 * 角色管理
 *
 * Class AclRoleController
 * @package App\Models
 *
 * @author  fengqi <lyf362345@gmail.com>
 * @copyright Copyright (c) 2015 udpower.cn all rights reserved.
 */
class AclRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$role = (new AclRole())->getRole();
        $role = AclUser::orderBy('id', 'desc')->get();
        return view('Admin.acl.role.index',['role'=>$role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = (new AclResource())->AclResource;

        //dd($resource);
        return view('Admin.acl.role.form', [
            'resource' => $resource
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resource = (new AclResource())->AclResource;
        $roleResource = AclRole::where('role', $id)->get()->all();


        //dd($resource);
        return view('Admin.acl.role.show', [
            'role' => $id,
            'resource' => $resource,
            'roleResource' => $roleResource,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resource = (new AclResource())->AclResource;

        $roleResource = AclRole::where('role', $id)->get(['resource'])->toArray();
        $roleResource = Arr::pluck($roleResource, 'resource');
        //dd($roleResource);

        return view('Admin.acl.role.form', [
            'role' => $id,
            'resource' => $resource,
            'roleResource' => $roleResource,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'resource' => 'required'
        ]);

        AclRole::where('role', $id)->delete();

        $resource = $request->get('resource');

        $aclRole = new AclRole();
        $data = [];
        foreach ($resource as $item) {
            $item = strtr($item, [' ' => '']);

            if (is_int(stripos($item, ','))) {
                $item = explode(',', $item);
                foreach ($item as $item2) {
                    $data[] = ['role' => $id, 'resource' => $item2];
                }
            } else {
                $data[] = ['role' => $id, 'resource' => $item];
            }
        }


        $aclRole->insert($data);

        return \Redirect::route('acl.role.index')->withErrors('更新角色权限成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
