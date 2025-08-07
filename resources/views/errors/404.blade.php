@extends('layouts.app')

@section('content')
    <div class="text-center">
        <div class="row">
            <div class="col-md-2 offset-md-5">
                <img class="img-fluid" src="{{asset('assets/media/image/404.png')}}" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="font-weight-800 m-b-20">صفحه مورد نظر یافت نشد!</h2>
                <p class="m-b-40 text-muted font-size-16">
                    برای بازگشت به صفحه داشبورد <a href="{{route("home")}}" class="font-weight-bolder"
                                                   style="border-bottom:1px dashed">اینجا</a> کلیک کنید.
                </p>
                <div class="row">
                    <div class="col-md-8 offset-md-2 col-xl-6 offset-xl-3">
                        <div class="input-group">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
