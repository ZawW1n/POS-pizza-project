@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>

                    @if (session('deleteSuccess'))
                       <div class="ms-3 col-4">
                          <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                 <i class="fa-regular fa-circle-xmark"></i> {{ session('deleteSuccess')}}
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                         </div>
                    @endif

                    <div class="row mb-1">
                        <div class="col-4">
                            <h4 class="text-secondary">Search Key : <span class="text-info">{{ request('key')}}</span> </h4>
                        </div>
                        <div class="col-4 offset-4">
                            <form action="{{ route('admin#list')}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search . . . " value="{{ request('key')}}">
                                    <button class="btn btn-secondary" type="submit" >
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row my-2 ">
                        <div class="col-1 offset-10 bg-success shadow-sm rounded">
                            <h5 class="text-black py-1 text-center"><i class="fa-solid fa-cookie"></i>{{$admin->total()}}</h5>
                        </div>
                    </div>

                    {{-- @if (count($admin) != 0 ) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a )
                                    <tr class="tr-shadow mb-3">
                                        <td class="col-2">
                                            @if($a->image == null)
                                                @if ($a->gender == 'male')
                                                     <img src="{{ asset('images/default_user.jpeg')}}" class="shadow-sm img-thumbnail">
                                                @else
                                                    <img src="{{ asset('images/AdobeStock_112826502-300x300.jpeg')}}" class="shadow-sm img-thumbnail">
                                                @endif
                                            @else
                                            <img src="{{ asset('storage/'.$a->image)}}" class="shadow-sm img-thumbnail">
                                            @endif
                                        </td>
                                        <td>{{ $a->name}}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $a->id)
                                                    <p class="muted-text">You</p>
                                                @else
                                                        <a href="{{ route('admin#changeRole',$a->id)}}" class="me-1">
                                                            <i class="fa-solid fa-user-minus"></i>
                                                        </a>
                                                        <a href="{{ route('admin#delete',$a->id)}}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>

                                                @endif
                                             </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class=" mt-3">
                            {{ $admin ->links()}}
                            {{-- {{ $categories->appends(request()->query())->links()}} --}}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- END MAIN CONTENT-->
@endsection
