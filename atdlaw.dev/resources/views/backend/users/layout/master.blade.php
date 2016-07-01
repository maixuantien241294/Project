@extends('backend.layouts.master')
@section('title')
    Quản trị viên - @yield('child-title')
@endsection
@section('name')
    @yield('child-name')
@endsection
@section('head')
    {!! Html::style('assets/backend/plugins/metisMenu/dist/metisMenu.min.css') !!}
@endsection
@yield('child-head')
@section('addactive')
    @yield('child-addctive')
@endsection
@section('content')
    <div class="row" style="padding: 10px;">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! trans('users.menu') !!}</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu">
                                <li>
                                    <a href="#"><i class="fa fa-adjust fa-fw"></i> {{ trans('users.user.label') }}<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="{!! route('admin.users.create') !!}">{{ trans('systems.create') }}</a>
                                        </li>
                                        <li>
                                            <a href="{!! route('admin.users.index') !!}">{{ trans('systems.list') }}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-adjust fa-fw"></i> {{ trans('users.group.label') }}<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="{!! route('admin.users.groups.create') !!}">{{ trans('systems.create') }}</a>
                                        </li>
                                        <li>
                                            <a href="{!! route('admin.users.groups.index') !!}">{{ trans('systems.list') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-info">
                @yield('child-content')
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@section('footer')
    {!! Html::script('assets/backend/plugins/metisMenu/dist/metisMenu.min.js') !!}
    <script type="text/javascript">
        $(function() {
            $('#side-menu').metisMenu();
        });

    </script>
@endsection
@yield('child-footer')