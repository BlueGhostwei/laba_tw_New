@extends('Admin.layout.main')
@section('title', '角色权限修改')
@section('header_related')
@endsection
@section('content')
    <div class="content">
        <div class="Invoice">
            <div class="INa1dd">
                <div class="ndt" style="margin-top:40px;padding-bottom:0;">
                    <form action="{{ route('acl.role.update', $role) }}" method="post"
                          class="form-horizontal bv-form" novalidate="novalidate">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                        <div class="hdorder radius1">
                            <h3 class="title1"><strong><a href="#">修改角色权限</a></strong></h3>
                            <div class="premissions">
                                <h3>{{role2text($role)}}</h3>

                                <div style="width: 100%; height: auto;float: left; padding-bottom: 3%;min-height: 500px;">
                                    @foreach($resource as $model => $item)
                                        <div class="PRlist">
                                            <p> {{$model}}</p>
                                            @foreach($item as $func => $action)
                                                <li><input class="tc-check" name="resource[]"
                                                           value="{{ is_array($action) ? implode(',', $action) : $action }}"
                                                           type="checkbox" {{ roleResourceChecked($action, $roleResource) }}> {{ $func }}
                                                </li>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <input type="submit" name="" value="提交">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
