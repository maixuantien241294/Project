<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{csrf_token() }}">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        {!! Html::style('assets/backend/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('assets/backend/fontawesome/css/font-awesome.min.css') !!}
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        {!! Html::style('assets/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}
        {!! Html::style('assets/backend/dist/css/AdminLTE.min.css') !!}
        {!! Html::style('assets/backend/dist/css/skins/_all-skins.min.css') !!}
        {!! Html::style('assets/backend/css/main.css') !!}
        {{--add style--}}
        {!! Html::script('assets/backend/plugins/jQuery/jQuery-2.1.4.min.js') !!}
        {!! Html::script('assets/backend/bootstrap/js/bootstrap.min.js') !!}
        {!! Html::script('assets/backend/dist/js/app.min.js') !!}
        {!! Html::script('assets/backend/plugins/sparkline/jquery.sparkline.min.js') !!}
        {!! Html::script('assets/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}
        {!! Html::script('assets/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}
        {!! Html::script('assets/backend/plugins/slimScroll/jquery.slimscroll.min.js') !!}
        {!! Html::script('assets/backend/js/main.js') !!}
        {!! Html::script('assets/backend/js/scrolltopcontrol.js') !!}
        {!! Html::script('assets/backend/dist/js/demo.js') !!}
        {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>--}}
        {{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}

        @yield('head')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            @include('backend.define.header')
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{!!  URL::to('assets/backend/dist/img/user2-160x160.jpg') !!}" class="img-circle" alt="User Image">

                    </div>
                    @if(Sentry::check())
                    <div class="pull-left info">
                        <p>{!! Sentry::getUser()->first_name.' '.Sentry::getUser()->last_name !!}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                    @endif
                </div>

                <!--start:menu-->
                <?php
                    $menus = \Config::get('menu');
                    $calatlog_menu = $menus[0];
                    //$news_menu = $menus[1];
                ?>
                <ul class="sidebar-menu">
                    <li class="active treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>{!! trans('menus.home') !!}</span>
                        </a>

                    </li>
                    @foreach(\Config::get('menu') as $menu)
                        <li class="treeview">
                            <a href="javascript:void(0)"><i class="{!! $menu['icon'] !!}"></i><span>{!! trans('menus.'.$menu['name']) !!}</span>@if(isset($menu['child']) && count($menu['child'])>0) <i class="fa fa-angle-left pull-right"></i> @endif</a>
                            @if(!$menu['hide'])
                                @if(isset($menu['child']) &&  count($menu['child'])>0)
                                <ul class="treeview-menu">
                                    @foreach($menu['child'] as $item)
                                        <li>
                                            <a href="{!! route( $item['route'] ) !!}"><i class="{!! $item['icon'] !!}"></i>{!! trans('menus.'.$item['name']) !!}@if(isset($item['child1']) && count($item['child1'])>0) <i class="fa fa-angle-left pull-right"></i> @endif</a>
                                            @if(isset($item['child1']) && count($item['child1'])>0)
                                                <ul class="treeview-menu">
                                                    @foreach($item['child1'] as $value)
                                                        <li>
                                                            <a href="{!! route( $value['route'] ) !!}"><i class="{!! $value['icon'] !!}"></i>{!! trans('menus.'.$value['name']) !!}@if(isset($value['child2']) && count($value['child2'])>0) <i class="fa fa-angle-left pull-right"></i> @endif</a>
                                                            @if(isset($value['child2']) && count($value['child2'])>0)
                                                                <ul class="treeview-menu">
                                                                    @foreach($value['child2'] as $child2)
                                                                        <li><a href="{!! route( $child2['route'] ) !!}"><i class="{!! $child2['icon'] !!}"></i>{!! trans('menus.'.$child2['name']) !!}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                            @endif
                        </li>
                    @endforeach
                </ul>
                <!--end:menu-->
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>@yield('name')</h1>
                <ol class="breadcrumb">
                    <li><a href="{!! route('admin.home') !!}"><i class="fa fa-dashboard"></i> {!! trans('menus.home') !!}</a></li>
                    @yield('addactive')
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                            @if(Session::has('message'))
                            <div class="alert notify  {!! Session::get('alert-class') !!}  alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i>{!! trans('systems.confirm') !!}</h4>
                                {!! Session::get('message') !!}
                            </div>
                            <script type="text/javascript">
                                    window.setTimeout(function() { $(".notify").fadeTo(1500, 0).slideUp(500, function(){
                                        $(this).remove();
                                    }); }, 5000);
                                </script>
                            @endif
                            @yield('content')
                            <div class="modal fade" tabindex="-1" id="comfirm" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">{!! trans('systems.confirm') !!}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>{!! trans('systems.action.alert') !!}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('systems.action.no') !!}</button>
                                            <a href="" id='delete' type="button" class="btn btn-primary">{!! trans('systems.action.yes') !!}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.3.2
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>

        @include('backend.define.aside')
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>

    <script type="text/javascript">

        !function(){
            $(function(){
                $('#btnconfirm').click(function(e){
                    e.preventDefault();
                    var url=$(this).attr('href');
                    $('#delete').attr('href',url);
                    $('#comfirm').modal('show');
                });
            });
        }(window.jquery);
    </script>


    @yield('footer')
    </body>
</html>
