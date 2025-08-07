@extends('layouts.app')
@section('styles')
    @parent
    <!-- begin::croppie -->
    <link rel="stylesheet"
          href="{{asset('css/croppie.css')}}" type="text/css">
    <!-- end::croppie -->
@stop

@section('title', '| Create Users')
@section('content')

    <div class="page-header">
        <div>
            <h4><i class='fa fa-user ml-2'></i> ایجاد کاربر </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">لیست کاربران</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد کاربر</li>
                </ol>
            </nav>
        </div>
    </div>
    {{ Form::open(array('url' => 'users','files'=>'true')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            {{ Form::label('name', 'نام و نام خانوادگی') }}
                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                        </div>
                        <div class="col-md-4 mb-4">
                            {{ Form::label('email', 'ایمیل') }}
                            {{ Form::email('email', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            {{ Form::label('phone', 'شماره همراه (نام کاربری)') }}
                            {{ Form::text('phone', null, array('class' => 'form-control')) }}
                        </div>
                        <div class="col-md-4 mb-4">
                            {{ Form::label('password', 'رمز عبور') }}
                            {{ Form::password('password', array('class'=>'form-control' ) ) }}
                        </div>
                        <div class="col-md-4 mb-4">
                            {{ Form::label('password_confirmation', 'تکرار رمز عبور') }}
                            {{ Form::password('password_confirmation', array('class'=>'form-control' ) ) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">اختصاص دستبندی نمودار ها به کاربر</h5>
                    <div class="form-group">
                        @foreach ($ChartCategories as $Categorie)
                            <div class="custom-control custom-checkbox custom-control-inline">
                                {{ Form::checkbox('chartCategories[]',  $Categorie->id ,null, ['class' => 'custom-control-input' , 'id' => 'chartCategories_'.$Categorie->id]) }}
                                {{ Form::label('chartCategories_'.$Categorie->id, ucfirst($Categorie->title) , ['class' => 'custom-control-label']) }}
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <h5 class="card-title">اختصاص مجوز ها به کاربر</h5>
                    @if(!$roles->isEmpty())
                        <div class="form-group">
                            @foreach ($roles as $role)
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    {{ Form::checkbox('roles[]',  $role->id ,null, ['class' => 'custom-control-input' , 'id' => $role->id]) }}
                                    {{ Form::label($role->id, ucfirst($role->name) , ['class' => 'custom-control-label']) }}
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                {{ Form::submit('ایجاد کاربر', array('class' => 'btn btn-primary')) }}
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('permissions.create')}}" class="btn btn-primary text-white">ایجاد
                                    مجوز</a>
                            </div>
                        </div>
                    @else
                        <p>مجوزی تا به اکنون ایجاد نشده است.</p>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <a href="{{route('permissions.create')}}" class="btn btn-primary text-white">ایجاد
                                    مجوز</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p>تصویر کاربر</p>
                    <div class="panel panel-default">
                        <div class="panel-body file-upload" align="center">
                            {{ Form::hidden('avatar', null, array('id' => 'avatar')) }}
                            {{ Form::label('upload_image', 'تصویر خود را انتخاب نمایید', ['class' => 'file-upload__label']) }}
                            {{ Form::file('upload_image', ['class' => 'file-upload__input'], array('id' => 'upload_image')) }}
                            <br/>
                            <div id="uploaded_image"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="uploadimageModal" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="image_demo" style="width:350px; margin-top:30px"></div>
                        </div>
                        <div class="col-md-12 text-center" style="padding-top:30px;">
                            <a class="btn btn-success crop_image">آپلود تصویر</a>
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
    <!-- begin::croppie -->
    <script type="text/javascript"
            src="{{asset('js/croppie.js')}}"></script>
    <!-- end::croppie -->
    <script type="text/javascript">
        $(document).ready(function () {

            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width: 300,
                    height: 300,
                    type: 'circle' //circle
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });

            $('#upload_image').on('change', function () {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function () {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });


            $('.crop_image').click(function (event) {
                var _token = $('input[name ="_token"]').val();
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (response) {
                    $.ajax({
                        url: '{{route('users.uploadCrop.ajax')}}',
                        type: "POST",
                        data: {
                            "image": response,
                            _token: _token
                        },
                        success: function (data) {
                            $('#uploadimageModal').modal('hide');
                            $('#uploaded_image').html(data['img']);
                            $('#avatar').val(data['imageName']);
                        }
                    });
                })
            });

        });

        @if (Route::currentRouteName() == 'users.create')
        $(".side-menu-body ul li").removeClass("open");
        $(".usersRoot").addClass("open");
        $(".usersParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        $(".usersCreate").addClass("active");
        @endif
    </script>
@stop
