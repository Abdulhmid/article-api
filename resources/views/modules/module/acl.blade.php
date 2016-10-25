@extends('layouts.admin')

@section('style')
    <link href="{!! asset('plugins/sweet-alert/sweet-alert.css') !!} " rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/iCheck/all.css') !!} " rel="stylesheet" type="text/css"/>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-6">
                                <h3 class="box-title">Daftar {!! $title !!}<b>  </b></h3>
                            </div>
                            <div class="col-xs-6">
                                <div class="pull-right">
                                    <a href="{!! url('/modules') !!}" data-original-title="Add" data-toggle="tooltip"
                                       class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        @if(Session::has('message'))
                            {!! GlobalHelper::messages(Session::get('message')) !!}
                        @endif

                        @if(Session::has('erroracl'))
                            {!! GlobalHelper::messages(Session::get('erroracl'), true) !!}
                        @endif

                        {!! Form::open(['url'=>GLobalHelper::indexUrl().'/storeAcl', 'class'=>'form-horizontal']) !!}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Menu</th>
                                    @foreach($groups as $key => $value)
                                        <th> {!! $value['group_name'] !!}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td></td>
                                    @foreach($groups as $key => $value)
                                        <td>
                                            <div class="col-xs-4 icheckbox" style="padding-bottom:1px">
                                                <input type="checkbox" name="check_module" data-group="{!! $key !!}"
                                                       title="Pilih Semua untuk Grup {!! $value['group_name'] !!} ">
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($modules as $valueModule)

                                    <tr class="success">
                                        <td><b>Modul: {!! $valueModule->module_name_alias !!}</b></td>
                                        @foreach($groups as $key => $value)
                                            <td>
                                                <div class="col-xs-4 icheckbox" style="padding-bottom:1px">
                                                    <input type="checkbox" name="check_sub_module" data-group="{!! $key !!}"
                                                           data-module="{!! $valueModule->module_id !!}"
                                                           title="Pilih Semua untuk Grup {!! $value['group_name'] !!} di Modul {!! $valueModule->module_name_alias !!}">
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                    @foreach(AclHelper::takeFunction($valueModule->module_id) as $key => $valuefunction)
                                        <?php $functioName = AclHelper::takeNumberFunction($valueModule->module_id, $key); ?>
                                        <tr>
                                            <td><b>Fungsi : </b> {!! ucfirst($valuefunction) !!}</td>
                                            @foreach($groups as $key => $value)
                                                <td>
                                                    <div class="col-xs-4 icheckbox" style="padding-bottom:1px">
                                                        <input type="checkbox"
                                                               class="group_{!! $key !!} group_{!! $key !!}_module_{!! $valueModule->module_id !!}"
                                                               name="function{!! $value->group_id.$valueModule->module_id.$functioName !!}"
                                                                {!! AclHelper::takePermissionFunction($value->group_id, $valueModule->module_id, $functioName) !!}
                                                        >
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                        <div class="clearfix"></div>
                        <div class="box-footer">
                            <div class="pull-right">
                                <button class="btn btn-danger" type="button" id="reset" style="display: none;">
                                    <i class="fa fa-refresh" style="margin-right:5px"></i> Kembali
                                </button>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-file" style="margin-right:5px"></i> Simpan
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        {!! Form::close() !!}

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
@stop

@section('script')
    <script src="{!! asset('plugins/sweet-alert/sweet-alert.js') !!} " type="text/javascript"></script>
    <script src="{!! asset('js/alert.js') !!} " type="text/javascript"></script>
    <script type="text/javascript" src="{!! asset('plugins/iCheck/icheck.min.js') !!}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var checkModule = $("input[name='check_module']");
            var checkSubModule = $("input[name='check_sub_module']");
            var checks = $("input[type='checkbox']");

            checks.not(checkSubModule).not(checkModule).iCheck({
                checkboxClass: 'icheckbox_square-green',
                increaseArea: '20%'
            });

            checkModule.on('ifCreated', function (event) {
                        if (this.title) {
                            $(this).parent().attr('title', $(this).attr('title'));
                        }
                    })
                    .iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        increaseArea: '20%'
                    })
                    .on('ifChanged', function (event) {
                        var id = $(this).data('group');
                        var targets = checks.filter(".group_" + id);
                        if (event.currentTarget.checked) {
                            targets.iCheck('check');
                        } else {
                            targets.iCheck('uncheck');
                        }

                    });

            checkSubModule.on('ifCreated', function (event) {
                        if (this.title) {
                            $(this).parent().attr('title', $(this).attr('title'));
                        }
                    })
                    .iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                        increaseArea: '20%'
                    })
                    .on('ifChanged', function (event) {
                        var group = $(this).data('group');
                        var module = $(this).data('module');
                        var targets = checks.filter(".group_" + group + "_module_" + module);
                        if (event.currentTarget.checked) {
                            targets.iCheck('check');
                        } else {
                            targets.iCheck('uncheck');
                        }

                    });

        });


    </script>
@stop
