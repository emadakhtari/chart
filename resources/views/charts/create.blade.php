@extends('layouts.app')
@section('styles')
    @parent
    <!-- begin::persianDatepicker -->
    <link rel="stylesheet"
          href="{{ URL::asset('css/persianDatepicker-default.css') }}" rel="stylesheet" type="text/css">
    <!-- end::persianDatepicker -->
@stop

@section('title', '| Create Charts')

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
    {{ Form::open(array('url' => 'charts', 'class' => 'form_with_date')) }}
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
                            <div class="form-row element" id="div_1">
                                <div class="item form-group col-md-5 mb-5">
                                    {{ Form::label('x_value', 'مقدار') }}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend"><span
                                                    class='add icon ti-plus bg-green'></span></span>
                                        </div>
                                        {{ Form::text('x_value[]', '', array('class' => 'form-control text-right','id' => 'txt_1','placeholder' => 'مقدار','dir' => 'ltr')) }}
                                    </div>
                                </div>
                                <div class="item form-group col-md-5 mb-5">
                                    {{ Form::label('y_value', 'تاریخ') }}
                                    {{ Form::text('y_value[]', '', array('class' => 'form-control text-right','id' => 'tyt_1','placeholder' => 'تاریخ','dir' => 'ltr')) }}
                                </div>
                            </div>
                        </div>
                    </div>
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
    <!-- begin::persianDatepicker -->
    <script type="text/javascript"
            src="{{ URL::asset('js/persianDatepicker.js') }}"></script>
    <!-- end::persianDatepicker -->

    <script type="text/javascript">

        $(".add").click(function () {
            var total_element = $(".element").length;
            var lastid = $(".element:last").attr("id");
            var split_id = lastid.split("_");
            var nextindex = Number(split_id[1]) + 1;

            $(".element:last").after("<div class='form-row element' id='div_" + nextindex + "'></div>");

            $("#div_" + nextindex).append(' <div class="item form-group col-md-5 mb-5"><label for="x_value">مقدار</label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="inputGroupDelete"><span id="remove_' + nextindex + '" class="remove icon ti-minus bg-red"></span></span></div><input class="form-control text-right" id="txt_' + nextindex + '" placeholder="مقدار" dir="ltr" name="x_value[]" type="text" value=""></div></div><div class="item form-group col-md-5 mb-5"><label for="y_value">تاریخ</label><input class="form-control text-right" id="tyt_' + nextindex + '" placeholder="تاریخ" dir="ltr" name="y_value[]" type="text"></div>');
            $("#tyt_" + nextindex).persianDatepicker({
                formatDate: "YYYY/0M/0D",
                selectedBefore: 0,
                cellWidth: 35,
                cellHeight: 35,
                fontSize: 14,
            });
        });

        $('.containers').on('click', '.remove', function () {
            var id = this.id;
            var split_id = id.split("_");
            var deleteindex = split_id[1];
            $("#div_" + deleteindex).remove();

        });

        $(document).ready(function () {
            $("#tyt_1").persianDatepicker({
                formatDate: "YYYY/0M/0D",
                selectedBefore: 0,
                cellWidth: 35,
                cellHeight: 35,
                fontSize: 14,
            });
        });

        @if (Route::currentRouteName() == 'charts.create')
        $(".side-menu-body ul li").removeClass("open");
        $(".chartCategoriesRoot").addClass("open");
        $(".chartsParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        $(".chartsCreate").addClass("active");
        @endif
    </script>
@stop
