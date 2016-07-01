@extends('backend.layouts.master')
@section('title')
    {!! trans('systems.create') !!} {!! trans('news.label') !!}
@endsection
@section('name')
    {!! trans('systems.create') !!} {!! trans('news.label') !!}
@endsection
@section('addactive')
    <li><a href="{!! route('admin.news.index') !!}">{!! trans('news.label') !!}</a> </li>
    <li class="active">{!! trans('systems.create') !!}</li>
@endsection
@section('content')
    <div class="box-header with-border">
        <h3 class="box-title">{!! trans('systems.create') !!}&nbsp; {!! trans('news.label') !!}</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
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
    {!! Form::open(['url'=>route('admin.news.store'),'rode'=>'form','files'=> true,'class'=>'form-horizontal']) !!}
    <div class="row">
       <div class="col-sm-8">
            <div class="box-body" style="border: 1px solid #ccc; border-radius: 5px; margin-left: 5px;">
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">{{ trans('news.name') }} (<span class="required" style="color:red">*</span>) :</label>
                    <div class="col-sm-8">
                        {!! Form::text('name',Request::old('name'),['class'=>'form-control','id'=>'name']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="code" class="col-sm-4 control-label">{{ trans('news.summary') }} (<span class="required" style="color:red">*</span>) :</label>
                    <div class="col-sm-8">
                        {!! Form::text('code',Request::old('code'),['class'=>'form-control','id'=>'code']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="summary" class="col-sm-4 control-label">{{ trans('catalogs.summary') }} (<span class="required" style="color:red">*</span>) :</label>
                    <div class="col-sm-8">
                        {!! Form::textarea('summary',Request::old('summary'),['class'=>'form-control ckeditor','id'=>'summary','rows' => 3, 'maxlength' => 255]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="logo" class="col-sm-4 control-label">{{ trans('catalogs.logo') }} (<span class="required" style="color:red">*</span>) :</label>
                    <div class="col-sm-8">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-preview thumbnail" style="min-height: 150px; max-height: 250px; max-width: 250px;">
                            </div>
                            <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileupload-new">
                                    {{ trans('systems.select_image') }}
                                </span>
                                {{ Form::file('images', [ "accept" => "image/*" ]) }}
                            </span>
                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">
                                    {{ trans('systems.remove') }}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="menu_img" class="col-sm-4 control-label">{{ trans('catalogs.show_on_homepage') }} (<span class="required" style="color:red">*</span>) :</label>
                    <div class="col-sm-8">
                        {!! Form::checkbox('show_on_homepage', true, true, ['id' => 'active-checker']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-4 control-label">{{ trans('catalogs.status') }} (<span class="required" style="color:red">*</span>) :</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="status" name="status">
                            <option value="1"> {!! trans('systems.visiable') !!}</option>
                            <option value="0"> {!! trans('systems.invisiable') !!}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pre_order" class="col-sm-4 control-label">{{ trans('catalogs.pre_order') }} (<span class="required" style="color:red">*</span>) :</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="order" name="order">
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    {!! Html::link(route( 'admin.news.index' ), trans('systems.cancel'), ['class' => 'btn btn-default']) !!}
                    {!! Form::submit(trans('systems.save'), ['class' => 'btn btn-primary']) !!}
                    <span class="label label-danger message"></span>
                </div>
            </div>
       </div>
       <div class="col-sm-4">
            <div class="box-body" style="border:1px solid #ccc; border-radius: 5px;">
                <label for="status" class=" control-label">{{ trans('systems.languge_name') }}</label>
                <div class="form-group">
                    <label for="status" class=" col-sm-3 control-label"><img style="float: left;margin-left: 15px;" src="{!! URL::to('assets/backend/img/vn.gif') !!}" alt="Img" ></label>
                    <div class="col-sm-9">
                        <select class="form-control" id="status" name="status">
                            <option value="vi"> {!! trans('systems.languge.vi') !!}</option>
                            <option value="en"> {!! trans('systems.languge.en') !!}</option>
                        </select>
                    </div>
                </div>
                <label for="status" class=" control-label">{{ trans('systems.translations') }}</label>
                <div class="form-group">
                    <label for="status" class=" col-sm-3 control-label"><img src="{!! URL::to('assets/backend/img/en.gif') !!}" alt="Img" > <a href="{!! route('admin.news.index') !!}"><i class="glyphicon glyphicon-plus"></i></a></label>
                    <div class="col-sm-9">
                        {!! Form::text('name',Request::old('name'),['class'=>'form-control','id'=>'name']) !!}
                    </div>
                </div>
            </div>
       </div>
    </div>

    {!! Form::close() !!}
@endsection
@section('footer')
    {!! Html::script('assets/backend/plugins/ckeditor/ckeditor.js') !!}
    <script type="text/javascript">
             CKEDITOR.replace( 'summary',
             {
              customConfig : 'config.js',
              toolbar : 'simple'
              })
    </script>
     {{--@include('backend.plugins.ckeditor')--}}
@endsection