@extends('layouts.admin')

@section('style')
    <link href="{!! asset('plugins/iCheck/all.css') !!} " rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/iCheck/square/green.css') !!}" rel="stylesheet" type="text/css"/>
	<link href="{!! asset('plugins/sweet-alert/sweet-alert.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/ezdz/jquery.ezdz.min.css') !!} " rel="stylesheet" type="text/css"/>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary ">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-6">
                                <h3 class="box-title">{!! str_contains(Request::segment(2), 'create') ? 'Tambah' : 'Ubah' !!} {!! $title !!}</h3>
                            </div>
                            <div class="col-xs-6">
                                <div class="pull-right">
                                    <a href="{!! URL::to(GlobalHelper::indexUrl())!!}" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        @if(Session::has('message'))
                            {!! GlobalHelper::messages(Session::get('message')) !!}
                        @endif

                        {{-- Form --}}
                        {!! form_start($form) !!}
                        <div class="col-md-8">
                            {!! form_row($form->title, ['default_value' => isset($row) ? $row->title: '']) !!}

                            {!! form_row($form->tagline, ['default_value' => isset($row) ? $row->tagline: '']) !!}
                            
                            {!! form_row($form->tag, ['default_value' => isset($row) ? $row->tag: '']) !!}
                            {!! form_row($form->status,$options = ['attr' => ['class' => 'styled']]) !!}
                            <fieldset>
                                <legend class="text-bold">Meta Data</legend>
                                <div class="form-group" style="margin-left: -14px;">
                                    <label class="control-label col-lg-2">Meta Title</label>
                                        <div class="input-group" style="width: 568px;">
                                            {!! form_row($form->meta_title, ['default_value' => isset($row) ? $row->meta_title: '']) !!}
                                            <span class="input-group-addon bg-slate-700" style="display: none;"><i class="icon-help"></i></span>
                                        </div>
                                </div>
                                <div class="form-group" style="margin-left: -14px;">
                                    <label class="control-label col-lg-2">Meta Keyword</label>
                                    <div class="input-group" style="width: 568px;">
                                        {!! form_row($form->meta_keyword, ['default_value' => isset($row) ? $row->meta_keyword: '']) !!}
                                        <span class="input-group-addon bg-slate-700" style="display: none;"><i class="icon-help"></i></span>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left: -14px;">
                                    <label class="control-label col-lg-2">Meta Desription</label>
                                    <div class="input-group" style="width: 568px;">
                                        {!! form_row($form->meta_description, ['default_value' => isset($row) ? $row->meta_description: '']) !!}
                                        <span class="input-group-addon bg-slate-700" style="display: none;"><i class="icon-help"></i></span>
                                    </div>
                                </div>

                            </fieldset>

                        </div>
                        <div class="col-md-4">
                            <div class=" alert alert-dismissable" role="alert" id="alert-foto"
                                 style="display: none;">
                                <div class="callout callout-danger">
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                    <p><span id="error-foto"></span></p>
                                </div>
                            </div>
                            {!! form_row($form->photo) !!}
                            <div class="clearfix"></div>
                        </div>  

                    </div>
                    <div class="clearfix"></div>
                    @include('partial.form_button')
                    {!! form_end($form) !!}

                    {{-- End Form --}}
                </div>

            </div>
        </div>
    </section>

@stop

@section('script')
    <script type="text/javascript" src="{!! asset('plugins/iCheck/icheck.min.js') !!}"></script>
	<script src="{!! asset('plugins/sweet-alert/sweet-alert.js') !!} " type="text/javascript"></script>    
	<script src="{!! asset('js/alert.js') !!} " type="text/javascript"></script>
    <script type="text/javascript" src="{!! asset('plugins/ezdz/jquery.ezdz.min.js') !!}"></script>
    <script type="text/javascript">
        function readUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.readAsDataURL(input.files[0]);
            }
        }

        function chooseFile()
        {
            $('#file').click();
        }

        $(document).ready(function(){
            $('input[name="password"]').val('');
            $('input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
   
            //input file
            $('input[type="file"]').ezdz({

                text: 'drop or select a picture',

                validators: {
                    maxSize: 2000000
                },

                reject: function (file, errors) {

                    if (errors.mimeType) {
                        $("#error-foto").text("File harus berekstensi .png atau .jpg");
                        $('#alert-foto').show().delay(5000).fadeOut('slow');
                    }

                    if (errors.maxSize) {
                        $("#error-foto").text("Ukuran file tidak lebih dari 2 MB");
                        $('#alert-foto').show().delay(5000).fadeOut('slow');
                    }

                }
            });

            var otherHeight = $('.form-group').first().height();
            $('#category').height(function (index, height) {
                var minus = otherHeight - height;
                return (height + minus);
            });

            @if(isset($row))
                $('[type="file"]').ezdz('preview', "{!! asset($row->image) !!}");
            @endif
        });
    </script>
@stop
