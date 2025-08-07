@extends('layouts.app')
@section('styles')
    @parent
    <!-- begin::dataTable -->
    <link rel="stylesheet"
          href="{{asset('assets/vendors/dataTable/responsive.bootstrap.min.css')}}" type="text/css">
    <!-- end::dataTable -->
@stop

@section('title', '| Charts')

@section('content')
    <div class="page-header">
        <div>
            <h4><i class='fa fa-bar-chart ml-2'></i> لیست نمودار ها </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست نمودار ها</li>
                </ol>
            </nav>
        </div>
        @can('Create Charts')
            <div class="btn-group" role="group">
                <a href="{{ URL::to('charts/create') }}" class="btn btn-success text-white">ایجاد
                    نمودار</a>
            </div>
        @endcan

    </div>

    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-striped table-bordered">
                <thead class="text-center">
                <tr>
                    <th scope="col">شناسه</th>
                    <th scope="col">عنوان</th>
                    <th scope="col" class="d-table-cell">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @foreach ($charts as $chartCategorie)
                    <tr>
                        <td>
                            {{$chartCategorie->id}}
                        </td>
                        <td>
                            {{ $chartCategorie->title }}
                        </td>
                        <td class="d-block">
                            @can('Edit Charts')
                                <a href="{{ URL::to('charts/'.$chartCategorie->id.'/edit') }}"
                                   class="btn btn-info text-white d-inline-block" style="margin-right: 3px;"><i
                                        class="icon ti-marker-alt"></i></a>
                            @endcan
                            @can('Delete Charts')
                                {!! Form::open(['method' => 'DELETE', 'class'=>'d-inline-block', 'onsubmit' => 'return ConfirmDelete()' , 'route' => ['charts.destroy', $chartCategorie->id] ]) !!}
                                {!! Form::submit('حذف', ['class' => 'btn btn-danger d-inline-block']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot class="text-center">
                <tr>
                    <th scope="col">شناسه</th>
                    <th scope="col">عنوان</th>
                    <th scope="col" class="d-table-cell">عملیات</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <!-- begin::dataTable -->
    <script type="text/javascript"
            src="{{asset('assets/vendors/dataTable/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('assets/vendors/dataTable/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('assets/js/examples/datatable.js')}}"></script>
    <!-- end::dataTable -->
    <script type="text/javascript">
        function ConfirmDelete() {
            var x = confirm("آیا از حدف این آیتم اطمینان دارید؟");
            if (x)
                return true;
            else
                return false;
        }

        @if (Route::currentRouteName() == 'charts.index')
        $(".side-menu-body ul li").removeClass("open");
        $(".chartCategoriesRoot").addClass("open");
        $(".chartsParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        $(".chartsList").addClass("active");
        @endif
    </script>
@stop
