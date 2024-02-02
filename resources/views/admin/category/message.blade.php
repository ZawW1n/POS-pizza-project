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
                                <h2 class="title-1">From Customers Message</h2>

                            </div>
                        </div>

                    <div class="row my-2 ">
                        <div class="col-1 offset-10 bg-success shadow-sm rounded">
                            <h5 class="text-black py-1 text-center"><i class="fa-brands fa-cloudversify"></i>{{$contact->count()}}</h5>
                        </div>
                    </div>

                    {{-- @if (count($admin) != 0 ) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contact as $c)
                                    <tr>
                                        <td></td>
                                        <td>{{ $c->name}}</td>
                                        <td>{{ $c->email}}</td>
                                        <td>{{ $c->message}}</td>
                                        <td>{{ $c->created_at->format('F j, Y')}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- END MAIN CONTENT-->
@endsection
