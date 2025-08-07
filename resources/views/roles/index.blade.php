@extends('layouts.app')
@section('styles')
    @parent
    <!-- begin::dataTable -->
    <link rel="stylesheet"
          href="{{asset('assets/vendors/dataTable/responsive.bootstrap.min.css')}}" type="text/css">
    <!-- end::dataTable -->
@stop

@section('title', '| Roles')

@section('content')
    <div class="page-header">
        <div>
            <h4><i class='fa fa-key ml-2'></i> لیست نقش ها </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست نقش ها</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ URL::to('roles/create') }}" class="btn btn-success text-white">ایجاد نقش</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-striped table-bordered">
                <thead class="text-center">
                <tr>
                    <th scope="col">شناسه</th>
                    <th scope="col">عنوان</th>
                    <th scope="col">مجوز ها</th>
                    <th scope="col" class="d-table-cell">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @foreach ($roles as $role)
                    <tr>
                        <td>
                            {{$role->id}}
                        </td>
                        <td>
                            {{ $role->name }}
                        </td>
                        <td>
                            {{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}
                        </td>
                        <td class="d-block">
                            <a href="{{ URL::to('roles/'.$role->id.'/edit') }}"
                               class="btn btn-info text-white d-inline-block" style="margin-right: 3px;"><i
                                    class="icon ti-marker-alt"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'class'=>'d-inline-block', 'onsubmit' => 'return ConfirmDelete()' , 'route' => ['roles.destroy', $role->id] ]) !!}
                            {!! Form::submit('حذف', ['class' => 'btn btn-danger d-inline-block']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot class="text-center">
                <tr>
                    <th scope="col">شناسه</th>
                    <th scope="col">عنوان</th>
                    <th scope="col">مجوز ها</th>
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

        @if (Route::currentRouteName() == 'roles.index')
        $(".side-menu-body ul li").removeClass("open");
        $(".permissionsRoot").addClass("open");
        $(".rolesParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        $(".rolesList").addClass("active");
        @endif
    </script>
@stop
