@extends('layouts.app')
@section('styles')
    @parent
@stop

@section('title', '| Create Chart Categories')
@section('content')
    <div class="page-header">
        <div>
            <h4><i class='fa fa-bar-chart ml-2'></i> ویرایش دستبندی نمودار </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('chartCategories.index')}}">لیست دستبندی نمودار ها</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش دستبندی نمودار <b>
                            : {{$chartCategories->title}}</b></li>
                </ol>
            </nav>
        </div>
    </div>
    {{ Form::model($chartCategories, array('route' => array('chartCategories.update', $chartCategories->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-8 mb-8">
                            {{ Form::label('title', 'عنوان') }}
                            {{ Form::text('title', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-md-8 mb-8">
                            {{ Form::submit('ویرایش دستبندی نمودار', array('class' => 'btn btn-primary')) }}
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

        @if (Route::currentRouteName() == 'chartCategories.edit')
        $(".side-menu-body ul li").removeClass("open");
        $(".chartCategoriesRoot").addClass("open");
        $(".chartCategoriesParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        @endif
    </script>
@stop
