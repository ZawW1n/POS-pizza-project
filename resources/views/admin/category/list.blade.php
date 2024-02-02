@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>

                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Category
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-4">
                            <h4 class="text-secondary">Search Key : <span class="text-info">{{ request('key')}}</span> </h4>
                        </div>
                        <div class="col-4 offset-4">
                            <form action="{{ route('category#list')}}" method="get">
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
                        <div class="col-1 offset-10 bg-white shadow-sm rounded">
                            <h5 class="text-black py-1 text-success text-center"><i class="fa-solid fa-cookie"></i> {{ $categories->total()}} </h5>
                        </div>
                    </div>

                    @if (count($categories) != 0 )
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category name</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category )
                                    <tr class="tr-shadow mb-3">
                                        <td>{{ $category->id }}</td>
                                        <td class="col-6">{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('F j, Y') }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button> --}}
                                                <a href="{{ route('category#edit',$category->id)}}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('category#delete',$category->id)}}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class=" mt-3">
                            {{ $categories ->links()}}
                            {{-- {{ $categories->appends(request()->query())->links()}} --}}
                        </div>
                    </div>
                    @else
                        <h3 class="text-secondary text-center">Oop  ! There is no Category Here ..!</h3>
                        <p class="text-secondary text-center">! Please Create Category !</p>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
