@extends('layouts.admin')

@section('style')
    <link href="{!! asset('plugins/iCheck/all.css') !!} " rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/iCheck/square/green.css') !!}" rel="stylesheet" type="text/css"/>
	<link href="{!! asset('plugins/tag-it/jquery.tagit.css') !!} "rel="stylesheet" type="text/css"/>
	<link href="{!! asset('plugins/tag-it/tagit.ui-zendesk.css') !!} "rel="stylesheet" type="text/css"/>
	<link href="{!! asset('plugins/sweet-alert/sweet-alert.css') !!} "rel="stylesheet" type="text/css"/>
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
                        {!! form_start($form, ['role' => 'form','data-toggle' => 'validator', 'id' => 'formsubject']) !!}
						<div class="col-md-6">
							{!! form_row($form->module_name, ['default_value' => isset($row) ? $row->module_name: '']) !!}
						</div>
						<div class="col-md-6">
							{!! form_row($form->module_name_alias, ['default_value' => isset($row) ? $row->module_name_alias: '']) !!}
						</div>

						<div class="col-md-6">
							{!! form_row($form->function, ['default_value' => isset($row) ? $row->function: '']) !!}
						</div>
						<div class="col-md-6">
							{!! form_row($form->function_alias, ['default_value' => isset($row) ? $row->function_alias: '']) !!}
						</div>
						<div class="col-md-12">
							{!! form_row($form->description, ['default_value' => isset($row) ? $row->description: '']) !!}
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
	<script src="{!! asset('plugins/tag-it/tag-it.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('plugins/sweet-alert/sweet-alert.js') !!} " type="text/javascript"></script>    
	<script src="{!! asset('js/alert.js') !!} " type="text/javascript"></script>
	<script type="text/javascript" src="{!! asset('plugins/iCheck/icheck.min.js') !!}"></script>
	<script type="text/javascript">
        $(function(){
			@if(GLobalHelper::actionUrl() == "edit")
				$("#module_name").keypress(function(e){ 
					e.preventDefault(); 
				});
				$('#tagType').tagit({
					readOnly : true
				});
			@endif

			$('#module_name').keyup(function(){
			    this.value = this.value.toLowerCase();
			});

            $('input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            })

            $('#tagType').tagit({
            	showAutocompleteOnFocus : true,
            	placeholderText: "Function Name",
			    onTagClicked: function(event, ui) {
					swal({   
						title: "Change Function",   
						text: "Only Use Comma (,)",   
						type: "input",   
						showCancelButton: true,   
						closeOnConfirm: false,   
						animation: "slide-from-top"
					}, 
					function(inputValue){   
						if (inputValue === false) return false;      
						if (inputValue === "") {     
							swal.showInputError("Can't Empty!");     
							return false   
						} 
						swal("Success!", "Function : " + inputValue, "success");
						$("#tagType").tagit("removeAll");
						var arrayList = inputValue.split(','); 
						$.each( arrayList, function( index, value ){
						    $("#tagType").tagit("createTag", value);
						});

					});
					jQuery('.sweet-alert input[type=text]:first' ).val($("#tagType").val());
			    }
            });
            $('#tagTypeAlias').tagit({
            	showAutocompleteOnFocus : true,
            	placeholderText: "Function Alias Name",
			    onTagClicked: function(event, ui) {
					swal({   
						title: "Change Alias Function",   
						text: "Must use comma (,)",   
						type: "input",   
						showCancelButton: true,   
						closeOnConfirm: false,   
						animation: "slide-from-top",   
						inputPlaceholder: "Write something"
					}, 
					function(inputValue){   
						if (inputValue === false) return false;      
						if (inputValue === "") {     
							swal.showInputError("Can't Empty!");     
							return false   
						} 
						swal("Success!", "Alias Function : " + inputValue, "success");
						$("#tagTypeAlias").tagit("removeAll");
						var arrayList = inputValue.split(','); 
						$.each( arrayList, function( index, value ){
						    $("#tagTypeAlias").tagit("createTag", value);
						});

					});
					jQuery('.sweet-alert input[type=text]:first' ).val($("#tagTypeAlias").val());
			    }
            }); 

            $("input#module_name").on({
	            keydown: function(e) {
	              if (e.which === 32)
	                return false;
	            },
	            change: function() {
	              this.value = this.value.replace(/\s/g, "");
	            }
            });

			$( "form" ).submit(function( event ) {
				var function_name = ($("#tagType").val() == "" ? 0 : ($("#tagType").val()).split(',').length ) ;
				var function_alias = ($("#tagTypeAlias").val() == "" ? 0 : ($("#tagTypeAlias").val()).split(',').length ) ;

			 	if (function_name != function_alias) {
					sweetAlert("Oops...", "Alias Name must same with Function Name Total!", "error");
			 		return false;
			 	}else{
			 		return true;
			 	}
			});           
        });
    </script>
@stop
