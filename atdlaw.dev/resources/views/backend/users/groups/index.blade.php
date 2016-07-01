@extends('backend.users.layout.master')
@section('child-title',trans('systems.management'))
@section('child-name',trans('users.group.label'))
@section('child-addctive')
    <li class="active">{!! trans('users.group.label') !!}</li>
@endsection
@section('child-content')
        <div class="box-header with-border">
            <h3 class="box-title">{!! trans('systems.list') !!}&nbsp;{!! trans('users.group.label') !!}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="box-body">
                    <div class="col-sm-5">
                        {{ $groups->firstItem() . ' ' . trans('systems.to') . ' ' . $groups->lastItem() . ' ( ' . trans('systems.total') . ' ' . $groups->total() . ' )' }}
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-2" style="margin-bottom:10px; ">
                {{ Html::link(URL::route('admin.users.groups.create'), trans('systems.create'), array('class' => 'btn btn-primary')) }}
            </div>
            <div class="col-md-10">
            <span  style='float: right;'>
            {!! $groups->appends( Request::except('page') )->links() !!}
            </span>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <?php $i = (($groups->currentPage() - 1) * $groups->perPage()) + 1; ?>
                @if (count($groups) > 0)
                    <table class='table table-striped table-bordered'>
                        <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">#</th>
                            <th style="text-align: center; vertical-align: middle;"> {{ trans('users.group.name') }} </th>
                            <th style="text-align: center; vertical-align: middle;"> {{ trans('users.group.count_pesion') }} </th>
                            <th style="text-align: center; vertical-align: middle;"> {{ trans('systems.action.name') }} </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($groups as $item)

                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{ $i++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    {!! $item->name!!}
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    {!! $item->user()->count() !!}
                                </td>
                                <td>
                                    @if($item->id!=1)
                                        <a href="{!! route('admin.attributes.categories.show',$item->id) !!}" class="text-success"data-toggle="tooltip" data-placement="bottom" title="show"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <a href="{!! route('admin.users.groups.edit',$item->id) !!}" class="text-primary"data-toggle="tooltip" data-placement="bottom" title="edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="{!! route('admin.attributes.categories.delete',$item->id) !!}"class="btn-confirm text-danger" id='btnconfirm'data-toggle="tooltip"data-placement="bottom" title="delete"><span class="glyphicon glyphicon-remove"></span></a>
                                    @endif

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
