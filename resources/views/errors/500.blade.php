@extends('layouts.app')

@section('content')
    <div class="text-center">
        <div class="row">
            <div class="col-md-2 offset-md-5">
                <img class="img-fluid" src="{{asset('assets/media/image/500.png')}}" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="font-weight-800 m-b-20">لطفا زمان دیگری وارد پرتال شوید</h2>
                <p class="m-b-40 text-muted font-size-18">
                    متاسفانه در حال حاظر <b class="text-danger">سرور</b> در دسترس نمی باشد!
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
