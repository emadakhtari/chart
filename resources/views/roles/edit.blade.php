@extends('layouts.app')
@section('styles')
    @parent
@stop

@section('title', '| Update Roles')
@section('content')

    <div class="page-header">
        <div>
            <h4><i class='fa fa-key ml-2'></i> ویرایش نقش </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">لیست نقش ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش نقش <b> : {{$role->name}}</b></li>
                </ol>
            </nav>
        </div>
    </div>
    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
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
                    <h5 class="card-title">اختصاص نقش به مجوز ها</h5>
                    @if(!$permissions->isEmpty())
                        <div class="form-group">
                            @foreach ($permissions as $permission)
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    {{ Form::checkbox('permissions[]',  $permission->id ,null, ['class' => 'custom-control-input' , 'id' => $permission->id]) }}
                                    {{ Form::label($permission->id, ucfirst($permission->name) , ['class' => 'custom-control-label']) }}
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                {{ Form::submit('ویرایش نقش', array('class' => 'btn btn-primary')) }}
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
                                <button class="btn btn-primary" type="submit">ویرایش نقش</button>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('permissions.create')}}" class="btn btn-primary text-white">ایجاد
                                    مجوز</a>
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
        @if (Route::currentRouteName() == 'roles.edit')
        $(".side-menu-body ul li").removeClass("open");
        $(".permissionsRoot").addClass("open");
        $(".rolesParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        @endif
    </script>
@stop
