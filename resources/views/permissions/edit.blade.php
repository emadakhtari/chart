@extends('layouts.app')
@section('styles')
    @parent
@stop

@section('title', '| Update Permission')
@section('content')

    <div class="page-header">
        <div>
            <h4><i class='fa fa-key ml-2'></i> ویرایش مجوز </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">لیست مجوز ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش مجوز <b> : {{$permission->name}}</b>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-8 mb-8">
                            {{ Form::label('name', 'عنوان') }}
                            {{ Form::text('name', null, array('class' => 'form-control')) }}

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
                    <h5 class="card-title">اختصاص مجوز به نقش ها</h5>
                    @if(!$roles->isEmpty())
                        <div class="form-group">
                            @foreach ($roles as $role)
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    {{--                                    {{ Form::hidden('roles['.$role->id.']', '0') }}--}}
                                    {{--                                    {{ Form::checkbox('roles['.$role->id.']',  $role->id ,null, ['class' => 'custom-control-input' , 'id' => $role->id]) }}--}}
                                    {{--                                    {{ Form::label($role->id, ucfirst($role->name) , ['class' => 'custom-control-label']) }}--}}

                                    {{ Form::checkbox('roles[]',  $role->id ,null, ['class' => 'custom-control-input' , 'id' => $role->id]) }}
                                    {{ Form::label($role->id, ucfirst($role->name) , ['class' => 'custom-control-label']) }}
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                {{ Form::submit('ویرایش مجوز', array('class' => 'btn btn-primary')) }}
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('roles.create')}}" class="btn btn-primary text-white">ایجاد نقش</a>
                            </div>
                        </div>
                    @else
                        <p>نقشی تا به اکنون ایجاد نشده است.</p>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                {{ Form::submit('ویرایش مجوز', array('class' => 'btn btn-primary')) }}
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('roles.create')}}" class="btn btn-primary text-white">ایجاد نقش</a>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        @if (Route::currentRouteName() == 'permissions.edit')
        $(".side-menu-body ul li a").removeClass("active");
        $(".side-menu-body ul li").removeClass("open");
        $(".permissionsRoot").addClass("open");
        $(".permissionsParent").addClass("open");
        @endif
    </script>
@stop
