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

                            <div class="ms-5 fs-4">
                                <a href="{{ route('admin#list')}}">
                                    <i class="fa-regular fa-circle-left"></i>
                                </a>
                            </div>

                            <div class="card-title">
                                <h6 class="text-center title-2">Change Role</h6>
                            </div>

                            <hr>
                            <form action="{{route('admin#change',$account->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-5">
                                        @if ( $account->image == null)
                                                @if ( $account->gender == 'male')
                                                        <img src="{{ asset('images/default_user.jpeg')}}" class="img-thumbnail">
                                                @else
                                                    <img src="{{ asset('images/AdobeStock_112826502-300x300.jpeg')}}" class="img-thumbnail">
                                                @endif
                                         @else
                                              <img src="{{ asset('storage/'.$account->image)}}" alt="John Doe" />
                                         @endif

                                         <div class="mt-2">
                                            <input type="file" disabled class="form-control" name="image" id="">
                                         </div>
                                         <div class="">
                                            <button class="tbn btn-info mt-2 col-12 rounded-bottom" type="submit">Change</button>
                                            <p class="text-danger mt-2">*Role Only Changing*</p>
                                         </div>
                                    </div>
                                    <div class="row col-7">
                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-user-pen me-2"></i> Name</label>
                                            <input id="cc-pament" value="{{ old('name',$account->name)}}" name="name" disabled type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Your Name">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-circle-user"></i> Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == "admin") selected @endif>Admin</option>
                                                <option value="user" @if ($account->role == "user") selected @endif>User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-envelope-open-text me-2"></i> Email</label>
                                            <input id="cc-pament" value="{{ old('email',$account->email)}}" name="email" disabled type="email" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Your Email">
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-phone-volume me-2"></i> Phone</label>
                                            <input id="cc-pament" value="{{ old('phone',$account->phone)}}" name="phone" disabled type="number" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Yout Phone Number">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-location-dot me-2"></i> Gender</label>
                                            <select name="gender" disabled class="form-control">
                                                <option value="">Choose...</option>
                                                <option value="male" @if ($account->gender == 'male')
                                                    selected @endif >Male</option>
                                                <option value="female" @if ($account->gender == 'female')
                                                    selected @endif >Female</option>
                                            </select>
                                    </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1"><i class="fa-solid fa-location-dot me-2"></i> Address</label>
                                            <textarea name="address" disabled class="form-control" id="cc-pament" cols="30" rows="10" placeholder="Enter Your Address">{{ old('address',$account->address)}}</textarea>
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
