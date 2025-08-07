@extends('layouts.app')
@section('styles')
    @parent
@stop

@section('title', '| Create Roles')
@section('content')
    {{--    header-start  --}}
    <div class="page-header">
        <div>
            <h4><i class='fa fa-key ml-2'></i> ایجاد نقش </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">لیست نقش ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد نقش</li>
                </ol>
            </nav>
        </div>
    </div>
    {{--    header-end  --}}

    {{--    body-start  --}}
    <div class="card">
{{--        roles--}}
        <form id="form" class="form form-vertical" name="form" method="post"
              action="{{route('roles')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationTooltip02">نام و نام خانوادگی</label>
                    <input type="text" class="form-control" id="validationTooltip02" placeholder="نام و نام خانوادگی"  required>
                    <div class="valid-tooltip">
                        صحیح است!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationTooltipUsername">نام کاربری</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                        </div>
                        <input type="text" class="form-control text-right" id="validationTooltipUsername" placeholder="نام کاربری" aria-describedby="validationTooltipUsernamePrepend" required dir="ltr">
                        <div class="invalid-tooltip">
                            لطفا یک نام کاربری انتخاب کنید.
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{--    body-end  --}}
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        @if (Route::currentRouteName() == 'roles.create')
        $(".side-menu-body ul li").removeClass("open");
        $(".permissionsRoot").addClass("open");
        $(".rolesParent").addClass("open");
        $(".side-menu-body ul li a").removeClass("active");
        $(".rolesCreate").addClass("active");
        @endif
    </script>
@stop
