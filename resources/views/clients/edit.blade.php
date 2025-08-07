@extends('layouts.app')
@section('styles')
    @parent
@stop

@section('title', '| Update Clients')
@section('content')
    <div class="page-header">
        <div>
            <h4><i class='fa fa-users ml-2'></i> ویرایش مصرف کننده </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('clients.index')}}">لیست مصرف کنندگان</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش مصرف کننده <b>
                            : {{$clients->name}}</b></li>
                </ol>
            </nav>
        </div>
    </div>
    {{ Form::model($clients, array('route' => array('clients.update', $clients->id), 'method' => 'PUT')) }}
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
                    <br>
                    <div class="form-row">
                        <div class="col-md-8 mb-8">
                            {{ Form::submit('ویرایش کاربر', array('class' => 'btn btn-primary')) }}
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

        @if (Route::currentRouteName() == 'clients.edit')
        $(".side-menu-body ul li").removeClass("open");
        $(".clientsRoot").addClass("open");
        $(".clientsParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        @endif
    </script>
@stop
