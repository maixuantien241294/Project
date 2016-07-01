@extends('backend.users.layout.master')
@section('child-title',trans('users.user.management'))
@section('child-name',trans('users.user.label'))
@section('child-addctive')
    <li><a href="{!! route('admin.users.index') !!}">{!! trans('users.user.label') !!}</a> </li>
    <li class="active">{!! trans('systems.management') !!}</li>
@endsection
@section('child-content')
    <div class="box-header with-border">
        <h3 class="box-title">{!! trans('systems.list') !!}&nbsp;{!! trans('users.group.label') !!}</h3>
    </div>
    <div class="box-body">
        <div class="row">
            {!! Form::open(['url'=>route('admin.users.index'),'role'=>'form','class'=>'form-horizontal','method'=>'GET']) !!}
            <div class="box-body">
                <div class="col-md-2">
                    {!! Form::label(trans('systems.action.name')) !!}
                    <div class="form-group">
                        {!! Form::submit(trans('systems.search'),['class'=>'btn btn-info','style'=>'margin-left:10%;padding-right:5%;']) !!}
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="name" class="control-label">{{ trans('users.user.groups') }}</label>
                        {!! Form::select('groupId',['0'=>trans('systems.all')]+$groups->toArray(),Request::old('groupId'),['class'=>'form-control','id'=>'description']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="box-body">
                <div class="col-sm-5">
                    {{ $users->firstItem() . ' ' . trans('systems.to') . ' ' . $users->lastItem() . ' ( ' . trans('systems.total') . ' ' . $users->total() . ' )' }}
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="col-md-2" style="margin-bottom:10px; ">
            {{ Html::link(URL::route('admin.users.create'), trans('systems.create'), array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-10">
            <span  style='float: right;'>
            {!! $users->appends( Request::except('page') )->links() !!}
            </span>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <?php $i = (($users->currentPage() - 1) * $users->perPage()) + 1;$labels = ['success', 'info', 'danger', 'warning']; ?>
            @if (count($users) > 0)
                <table class='table table-striped table-bordered'>
                    <thead>
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">#</th>
                        <th style="text-align: center; vertical-align: middle;"> {{ trans('users.user.name') }} </th>
                        <th style="text-align: center; vertical-align: middle;"> {{ trans('users.user.email') }} </th>
                        <th style="text-align: center; vertical-align: middle;"> {{ trans('users.user.groups') }} </th>
                        <th style="text-align: center; vertical-align: middle;"> {{ trans('users.user.last_login') }} </th>
                        <th style="text-align: center; vertical-align: middle;"> {{ trans('systems.action.name') }} </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $item)
                        <?php $group = Sentry::findUserByID( $item->id)->getGroups()->first(); ?>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">{{ $i++ }}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                <a href="{!! route('admin.users.show',$item->id) !!}">{!! $item->first_name.' '.$item->last_name!!}</a>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                {!! $item->email !!}
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <label class="label label-{!! $labels[ $group->id % 4 ] !!}">{!! $group->name !!}</label>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                {!! date("d-m-Y H:i:s", strtotime( $item->last_login )) !!}
                            </td>
                            <td>
                                <a href="{!! route('admin.attributes.categories.show',$item->id) !!}" class="text-success"data-toggle="tooltip" data-placement="bottom" title="show"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="{!! route('admin.users.groups.edit',$item->id) !!}" class="text-primary"data-toggle="tooltip" data-placement="bottom" title="edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! route('admin.attributes.categories.delete',$item->id) !!}"class="btn-confirm text-danger" id='btnconfirm'data-toggle="tooltip"data-placement="bottom" title="delete"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <div class="alert alert-info"> {{ trans('systems.no_record_found') }}</div>
            @endif
        </div>
    </div>
@endsection
