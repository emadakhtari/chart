@extends('layouts.app')
@section('styles')
    @parent
    <!-- begin::dataTable -->
    <link rel="stylesheet"
          href="{{asset('assets/vendors/dataTable/responsive.bootstrap.min.css')}}" type="text/css">
    <!-- end::dataTable -->
    <style>
        #example1_wrapper {
            font-size: 14px !important;
        }
    </style>
@stop

@section('title', '| Users')

@section('content')
    <div class="page-header">
        <div>
            <h4><i class='fa fa-key ml-2'></i> لیست کاربران </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست کاربران</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ URL::to('user/create') }}" class="btn btn-success text-white">ایجاد کاربر</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="font-size: 0">
            <table id="example1" class="table table-striped table-bordered" style="font-size: 14px !important;">
                <thead class="text-center">
                <tr>
                    <th scope="col">شناسه</th>
                    <th scope="col">نام و نام خانوادگی</th>
                    <th scope="col">ایمیل</th>
                    <th scope="col">تاریخ ایجاد</th>
                    <th scope="col">دسترسی کاربر</th>
                    <th scope="col" class="d-table-cell">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{$user->id}}
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        >
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{\Morilog\Jalali\Jalalian::forge($user->created_at)->format('Y/m/d - h:m:s')}}
                        </td>
                        <td>
                            {{  $user->roles()->pluck('name')->implode(' ') }}
                        </td>
                        <td class="d-block">
                            <a href="{{ URL::to('users/'.$user->id.'/edit') }}"
                               class="btn btn-info text-white d-inline-block" style="margin-right: 3px;"><i
                                    class="icon ti-marker-alt"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'class'=>'d-inline-block', 'onsubmit' => 'return ConfirmDelete()' , 'route' => ['users.destroy', $user->id] ]) !!}
                            {!! Form::submit('حذف', ['class' => 'btn btn-danger d-inline-block']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot class="text-center">
                <tr>
                    <th scope="col">شناسه</th>
                    <th scope="col">نام و نام خانوادگی</th>
                    <th scope="col">ایمیل</th>
                    <th scope="col">تاریخ ایجاد</th>
                    <th scope="col">دسترسی کاربر</th>
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

        @if (Route::currentRouteName() == 'users.index')
        $(".side-menu-body ul li").removeClass("open");
        $(".usersRoot").addClass("open");
        $(".usersParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        $(".usersList").addClass("active");
        @endif
    </script>
@stop
