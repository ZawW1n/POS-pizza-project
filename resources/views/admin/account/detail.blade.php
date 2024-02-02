@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            @if (session('updateSuccess'))
                                <div class="ms-3">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <i class="fa-regular fa-circle-xmark"></i> {{ session('updateSuccess')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if ( Auth::user()->image == null)
                                            @if ( Auth::user()->gender == 'male')
                                                  <img src="{{ asset('images/default_user.jpeg')}}" class="img-thumbnail">
                                            @else
                                                <img src="{{ asset('images/AdobeStock_112826502-300x300.jpeg')}}" class="img-thumbnail">
                                            @endif
                                     @else
                                          <img src="{{ asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                                     @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <h4 class="my-3"><i class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-envelope-open-text me-2"></i>{{ Auth::user()->email }}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-phone-volume me-2"></i>{{ Auth::user()->phone }}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-location-dot me-2"></i>{{ Auth::user()->address }}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-venus-mars me-2"></i> {{Auth::user()->gender}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('F j, Y') }}</h4>
                                </div>
                            </div>

                            <div class="row">
                                <a href="{{ route('admin#edit')}}">
                                    <div class="col-4 offset-2">
                                        <button class="btn btn-info"><i class="fa-regular fa-pen-to-square"></i> Edit Profile</button>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
