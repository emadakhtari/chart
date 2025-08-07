@extends('layouts.app')
@section('styles')
    @parent
@stop

@section('title', '| Create Permission')
@section('content')

    <div class="page-header">
        <div>
            <h4><i class='fa fa-key ml-2'></i> ایجاد مجوز </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">لیست مجوز ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد مجوز</li>
                </ol>
            </nav>
        </div>
    </div>
    {{ Form::open(array('url' => 'permissions')) }}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-8 mb-8">
                            {{ Form::label('name', 'عنوان') }}
                            {{ Form::text('name', '', array('class' => 'form-control')) }}
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
                                    {{ Form::checkbox('roles[]',  $role->id ,null, ['class' => 'custom-control-input' , 'id' => $role->name]) }}
                                    {{ Form::label($role->name, ucfirst($role->name) , ['class' => 'custom-control-label']) }}
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                {{ Form::submit('ایجاد مجوز', array('class' => 'btn btn-primary')) }}
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('roles.create')}}" class="btn btn-primary text-white">ایجاد نقش</a>
                            </div>
                        </div>
                    @else
                        <p>نقشی تا به اکنون ایجاد نشده است.</p>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                {{ Form::submit('ایجاد مجوز', array('class' => 'btn btn-primary')) }}
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
        @if (Route::currentRouteName() == 'permissions.create')
        $(".side-menu-body ul li").removeClass("open");
        $(".permissionsRoot").addClass("open");
        $(".permissionsParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        $(".permissionsCreate").addClass("active");
        @endif
    </script>
@stop
