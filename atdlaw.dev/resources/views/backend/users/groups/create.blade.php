@extends('backend.users.layout.master')
@section('child-title',trans('users.group.create'))
@section('child-name',trans('users.group.label'))
@section('child-addctive')
    <li><a href="{!! route('admin.users.groups.index') !!}">{!! trans('users.group.label') !!}</a> </li>
    <li class="active">{!! trans('systems.create') !!}</li>
@endsection
@section('child-content')
    <div class="box-header with-border">
        <h3 class="box-title">{!! trans('systems.create') !!}&nbsp;{!! trans('users.group.label') !!}</h3>
    </div>
    <div class="box-body">
        @if($errors->has())
            <div class="alert notify alert-danger alert-dismissible">
                {{ trans('messages.error') }}
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="box-body">
        {!! Form::open(['url'=>route('admin.users.groups.store'),'role'=>'form','class'=>'form-horizontal','file'=>true]) !!}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{ trans('users.group.name') }} (<span class="required" style="color:red">*</span>) :</label>
            <div class="col-sm-10">
                {!! Form::text('name',Request::old('name'),['class'=>'form-control','id'=>'name','placeholder'=>trans('users.group.name')]) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" >{{ trans('users.group.permissions') }} : </label>
            <div class="col-sm-10">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center;" >#</th>
                                <th rowspan="2" >Module</th>
                                <th colspan="4" style="text-align: center;" >Quyền</th>
                            </tr>
                            <tr>

                                <th>Xem</th>
                                <th>Thêm</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;?>
                            @foreach($permissions as $key=>$value)
                                <tr>
                                    <td>{!! $i++ !!}</td>
                                    <td>{!! trans('users.group.'.str_replace( '.', '_', $key )) !!}</td>
                                    <td><input type="checkbox" value="{!! $key.'.view' !!}" name="permissions[]" @if(!in_array('view',$value)) disabled @endif></td>
                                    <td><input type="checkbox" value="{!! $key.'.create' !!}" name="permissions[]" @if(!in_array('create',$value)) disabled @endif></td>
                                    <td><input type="checkbox" value="{!! $key.'.update' !!}" name="permissions[]" @if(!in_array('update',$value)) disabled @endif></td>
                                    <td><input type="checkbox" value="{!! $key.'.destroy' !!}" name="permissions[]" @if(!in_array('destroy',$value)) disabled @endif></td>
                                    @foreach($value as $k=>$v)
                                        @if(!in_array($v,['view','create','update','destroy']))
                                            <td><input type="checkbox" value="{!! $key.'.'.$v !!}" name="permissions[]"> </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="box-footer">
            {!! Html::link(route( 'admin.users.groups.index' ), trans('systems.cancel'), ['class' => 'btn btn-default']) !!}
            {!! Form::submit(trans('systems.save'), ['class' => 'btn btn-primary']) !!}
            <span class="label label-danger message"></span>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
