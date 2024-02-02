@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid rounded">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Admin Profile</h3>
                            </div>

                            <hr>
                            <form action="{{route('admin#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-5">
                                        @if ( Auth::user()->image == null)
                                                @if ( Auth::user()->gender == 'male')
                                                        <img src="{{ asset('images/default_user.jpeg')}}" class="img-thumbnail">
                                                @else
                                                    <img src="{{ asset('images/AdobeStock_112826502-300x300.jpeg')}}" class="img-thumbnail">
                                                @endif
                                         @else
                                              <img src="{{ asset('storage/'.Auth::user()->image)}}" class="img-thumbnail" />
                                         @endif

                                         <div class="mt-2">
                                            <input type="file" class="form-control   @error('image') is-invalid @enderror" name="image" id="">
                                                @error('image')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                         </div>
                                         <div class="">
                                            <button class="tbn btn-info mt-2 col-12 rounded-bottom" type="submit">Update</button>
                                         </div>
                                    </div>
                                    <div class="row col-7">
                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-user-pen me-2"></i> Name</label>
                                            <input id="cc-pament" value="{{ old('name',Auth::user()->name)}}" name="name" type="text" class="form-control
                                            @error('name')
                                        is-invalid
                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Name">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-envelope-open-text me-2"></i> Email</label>
                                            <input id="cc-pament" value="{{ old('email',Auth::user()->email)}}" name="email" type="email" class="form-control
                                            @error('email')
                                        is-invalid
                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-phone-volume me-2"></i> Phone</label>
                                            <input id="cc-pament" value="{{ old('phone',Auth::user()->phone)}}" name="phone" type="number" class="form-control
                                            @error('phone')
                                        is-invalid
                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Yout Phone Number">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-location-dot me-2"></i> Gender</label>
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose...</option>
                                                <option value="male" @if (Auth::user()->gender == 'male')
                                                    selected @endif >Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female')
                                                    selected @endif >Female</option>
                                            </select>
                                            @error('gender')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-location-dot me-2"></i> Address</label>
                                            <textarea name="address" class="form-control
                                            @error('address')
                                            is-invalid
                                            @enderror" id="cc-pament" cols="30" rows="10" placeholder="Enter Your Address">{{ old('address',Auth::user()->address)}}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                    </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-circle-user"></i> Role</label>
                                            <input id="cc-pament" value="{{ old('id',Auth::user()->role)}}" name="role" type="text" class="form-control
                                            @error('role')
                                                is-invalid
                                            @enderror" aria-required="true" aria-invalid="false" disabled>
                                            @error('role')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>


                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
