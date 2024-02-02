@extends('admin.layouts.master')

@section('title', 'Admin List Page')

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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table text-center table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                        @foreach ($admin as $a)
                                        <tr class="mb-3 tr-shadow">
                                            <input type="hidden" class="adminId" value="{{ $a->id}}">
                                            <td> @if($a->image == null)
                                                @if ($a->gender == 'male')
                                                     <img src="{{ asset('images/default_user.jpeg')}}" class="shadow-sm img-thumbnail">
                                                @else
                                                    <img src="{{ asset('images/AdobeStock_112826502-300x300.jpeg')}}" class="shadow-sm img-thumbnail">
                                                @endif
                                            @else
                                            <img src="{{ asset('storage/'.$a->image)}}" class="shadow-sm img-thumbnail">
                                            @endif</td>
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
                                                    <select class="form-control changeRole" id="role">
                                                        <option value="admin" @if ($a->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user" @if ($a->role == 'user') selected @endif>User</option>
                                                    </select>
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
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
       $(document).ready(function(){
            // change role
            $('.changeRole').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $adminId = $parentNode.find('.adminId').val();

                $data = {
                    'adminId' : $adminId ,
                    'role' : $currentStatus
                }

                $.ajax({
                    type: 'get',
                    url: '{{ route("ajax#adminChangeRole")}}',
                    data: $data,
                    dataType: 'json' ,
                })
                location.reload();

             })

        })
    </script>
@endsection

