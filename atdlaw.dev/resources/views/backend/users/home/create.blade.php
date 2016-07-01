@extends('backend.users.layout.master')
@section('child-title',trans('users.user.create'))
@section('child-name',trans('users.user.label'))
@section('child-addctive')
    <li><a href="{!! route('admin.users.index') !!}">{!! trans('users.user.label') !!}</a> </li>
    <li class="active">{!! trans('systems.create') !!}</li>
@endsection
@section('child-content')
    <div class="box-header with-border">
        <h3 class="box-title">{!! trans('systems.create') !!}&nbsp;{!! trans('users.user.label') !!}</h3>
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
        {!! Form::open(['url'=>route('admin.users.store'),'role'=>'form','class'=>'form-horizontal','file'=>true]) !!}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{ trans('users.user.last_name') }} (<span class="required" style="color:red">*</span>) :</label>
            <div class="col-sm-4">
                {!! Form::text('last_name',Request::old('last_name'),['class'=>'form-control','id'=>'name','placeholder'=>trans('users.user.last_name')]) !!}
            </div>
            <label for="name" class="col-sm-2 control-label">{{ trans('users.user.first_name') }} (<span class="required" style="color:red">*</span>) :</label>
            <div class="col-sm-4">
                {!! Form::text('first_name',Request::old('first_name'),['class'=>'form-control','id'=>'first_name','placeholder'=>trans('users.user.first_name')]) !!}
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{ trans('users.user.email') }} (<span class="required" style="color:red">*</span>) :</label>
            <div class="col-sm-4">
                {!! Form::text('email',Request::old('email'),['class'=>'form-control','id'=>'email','placeholder'=>trans('users.user.email')]) !!}
            </div>
            {{--<label for="name" class="col-sm-2 control-label">{{ trans('users.user.groups') }} (<span class="required" style="color:red">*</span>) :</label>--}}
            {{--<div class="col-sm-4">--}}
                {{--{!! Form::select('groups',$group->toArray(),Request::old('groups'),['class'=>'form-control']) !!}--}}
            {{--</div>--}}
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{ trans('users.user.password') }} (<span class="required" style="color:red">*</span>) :</label>
            <div class="col-sm-4">
                {!! Form::password('password',['class'=>'form-control','placeholder'=>trans('users.user.password')]) !!}
            </div>
            <label for="repassword" class="col-sm-2 control-label">{{ trans('users.user.repassword') }} (<span class="required" style="color:red">*</span>) :</label>
            <div class="col-sm-4">
                {!! Form::password('repassword',['class'=>'form-control','placeholder'=>trans('users.user.repassword')]) !!}
            </div>
        </div>
        <div class="form-group">
            <label for="status" class="col-sm-2 control-label">{{ trans('users.user.status') }} (<span class="required" style="color:red">*</span>) :</label>
            <div class="col-sm-4">
                {!! Form::select('status',['1'=>trans('systems.action_status.active'),'0'=>trans('systems.action_status.deactive')],Request::old('status'),['class'=>'form-control']) !!}
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
