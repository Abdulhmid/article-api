@extends('layouts.admin')

@section('style')
    <link href="{!! asset('plugins/iCheck/all.css') !!} " rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/iCheck/square/green.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/clockpicker/bootstrap-clockpicker.min.css') !!} " rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/ezdz/jquery.ezdz.min.css') !!} " rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/select2/select2.min.css') !!} " rel="stylesheet" type="text/css"/>
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
                        <div class="col-md-7">
                            {!! form_row($form->username, ['default_value' => isset($row) ? $row->username: '']) !!}
                            {!! form_row($form->name, ['default_value' => isset($row) ? $row->name: '']) !!}
                            {!! form_row($form->email, ['default_value' => isset($row) ? $row->email: '']) !!}
                            {!! form_row($form->password,['default_value' => '']) !!}
                            {!! form_row($form->password_confirmation) !!}
                            {!! form_row($form->phone, ['default_value' => isset($row) ? $row->phone: '']) !!}
                            {!! form_row($form->active) !!}
                            {!! form_row($form->address) !!}
                        </div>
                        <div class="col-md-5">
                            
                            <div>
                               {!! form_row($form->group_id, ['attr' => ['selected' => isset($row) ? $row->group_id: '']]) !!}
                            </div>
                        
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
    <script type="text/javascript" src="{!! asset('plugins/clockpicker/bootstrap-clockpicker.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/select2/select2.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/ezdz/jquery.ezdz.min.js') !!}"></script>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAysR_Khm8Dxdz_aoAoYmIk9WO_ltt3lcs&libraries=places"></script>
    <script type="text/javascript">
        $(window).load(function () {
            // $("select#groupInput").trigger("click");
        });

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

        $(document).ready(function () {
            $('input[name="password"]').val('');
            $('input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
            $('.clockpicker').clockpicker({
                donetext: 'Masukkan'
            });

            $('.select2').select2();
   
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
                $('[type="file"]').ezdz('preview', "{!! asset($row->photo) !!}");
            @endif

        });


    </script>
@stop
