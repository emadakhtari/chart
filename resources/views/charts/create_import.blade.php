@extends('layouts.app')
@section('styles')
    @parent
@stop

@section('title', '| Create Charts (EXEL)')

@section('content')
    <div class="page-header">
        <div>
            <h4><i class='fa fa-bar-chart ml-2'></i> ایجاد نمودار </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('charts.index')}}">لیست نمودار ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد نمودار</li>
                </ol>
            </nav>
        </div>
    </div>
    {{ Form::open(array('route' => 'charts.store_import', 'enctype' => 'multipart/form-data', 'class' => 'form_with_date')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-5 mb-5">
                            {{ Form::label('title', 'عنوان') }}
                            {{ Form::text('title', '', array('class' => 'form-control')) }}
                        </div>
                        <div class="col-md-5 mb-5">
                            {{ Form::label('_value', 'مقدار') }}
                            {{ Form::text('_value', '', array('class' => 'form-control','placeholder' => 'مثال : ‌ریال')) }}
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-5 mb-5">
                            {{ Form::label('_type', 'نوع') }}
                            {!! Form::select('_type', array('' => 'انتخاب نمایید', 'line' => 'خطی', 'column' => 'میله ای'),null, array('class' => 'form-control roles')) !!}
                        </div>
                        <div class="col-md-5 mb-5">
                            {{ Form::label('category_id', 'دستبندی') }}
                            {!! Form::select('category_id', $categories->prepend('انتخاب نمایید', '') ,null, array('class' => 'form-control roles')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ایجاد محتوای نمودار</h5>
                    <div class="form-group fieldGroup">
                        <div class="containers">
                            <div id="filename_total">
                                <span id="filename"></span>
                                <label class="file-upload-label" for="file-upload">
                                    <i style="display: inline-block">آپلود فایل Exel</i>
                                    <b class="icon ti-upload" style="display: inline-block;margin-right: 10px"></b>
                                    <input type="file" id="file-upload" name="fileExcel">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>


                    <br>
                    <div class="form-group">
                        <div class="col-md-8 mb-8">
                            {{ Form::submit('ایجاد نمودار', array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ Form::close() }}
@endsection


@section('scripts')
    @parent
    <script type="text/javascript">

        $('#file-upload').change(function () {
            var filepath = this.value;
            var m = filepath.match(/([^\/\\]+)$/);
            var filename = m[1];
            $('#filename').html(filename);

            var ext = $('#file-upload').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['xlsx']) == -1) {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "rtl": 1
                }
                Command: toastr["error"]("فایل EXEL حتما بايد با پسوند 'xlsx' باشد.", "");
                $('#filename').text("");
                $('#file-upload').val("");
                a = 0;
            }

        });

        @if (Route::currentRouteName() == 'charts.create_import')
        $(".side-menu-body ul li").removeClass("open");
        $(".chartCategoriesRoot").addClass("open");
        $(".chartsParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        $(".chartsCreateImport").addClass("active");
        @endif
    </script>
@stop
