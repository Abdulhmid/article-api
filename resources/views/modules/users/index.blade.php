@extends('layouts.admin')

@section('style')
    <link href="{!! asset('plugins/datatables/dataTables.bootstrap.css') !!} " rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/sweet-alert/sweet-alert.css') !!} " rel="stylesheet" type="text/css"/>
@stop

@section('content')


<section class="content">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-xs-6">
                        <h3 class="box-title">Daftar {!! $title !!}</h3>
                    </div>
                    <div class="col-xs-6">
                        <div class="pull-right">
                            <a href="{!! url(GLobalHelper::indexUrl().'/create') !!}" data-original-title="Add" data-toggle="tooltip" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Tambah
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('message'))
                    {!! GlobalHelper::messages(Session::get('message')) !!}
                @endif
                    <div class="no-print alert alert-dismissable autohide full-alert" style="display: none;">
                        <div class="callout callout-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="fa fa-info"></i> Module berhasil ditambahkan!</h4>
                        </div>
                    </div>
                    <div class="table-responsive table-list table-list__user">
                        {!! $dataTable->table(['class' => 'table table-bordered table-hover']) !!}
                    </div>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
</section>
@stop

@section('script')
    <script src="{!! asset('plugins/datatables/jquery.dataTables.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('plugins/datatables/dataTables.bootstrap.js') !!} " type="text/javascript"></script>
    <script src="{!! asset('plugins/sweet-alert/sweet-alert.js') !!} " type="text/javascript"></script>
    <script src="{!! asset('js/alert.js') !!} " type="text/javascript"></script>
    <script>
		$(document).ready(function() {
		    $.extend(true, $.fn.dataTable.defaults, {
		        language: {
		            url: '//cdn.datatables.net/plug-ins/1.10.10/i18n/Chinese-traditional.json'
		        }
		    });
		});
    </script>
   	{!! $dataTable->scripts() !!}
@stop