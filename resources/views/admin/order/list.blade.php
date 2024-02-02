@extends('admin.layouts.master')

@section('title', 'Products List Page')

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
                                <h2 class="title-1">Orders List</h2>

                            </div>
                        </div>
                    </div>

                    <div class="mb-1 row">
                        <div class="col-4">
                            <h4 class="text-secondary">Search Key : <span class="text-info">{{ request('key')}}</span> </h4>
                        </div>

                        <div class="col-4 offset-4">
                            <form action="{{ route('admin#orderList')}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Enter Orders Code... " value="{{ request('key')}}">
                                    <button class="btn btn-secondary" type="submit" >
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('admin#changeStatus')}}" method="get" class="offset-7 col-5">
                        @csrf
                        <div class="d-flex mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa-solid fa-cookie"></i>{{ count($order) }}</span>
                            </div>
                            <select name="orderStatus" class="custom-select" id="inputGroupSelect02">
                                <option value="">All</option>
                                <option value="0" @if(request('orderStatus') == '0') selected @endif>Waiting</option>
                                <option value="1" @if(request('orderStatus') == '1') @endif>Accept</option>
                                <option value="2" @if(request('orderStatus') == '2') @endif>Reject</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark text-white">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table text-center table-data2">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                        @foreach ($order as $o)
                                        <tr class="mb-3 tr-shadow">
                                            <input type="hidden" class="orderId" value="{{ $o->id}}">
                                            <td>{{ $o->user_id}}</td>
                                            <td>{{ $o->user_name}}</td>
                                            <td>{{ $o->created_at->format('F j, Y')}}</td>
                                            <td>
                                                <a href="{{route('admin#listInfo',$o->order_code)}}" class="text-primary">{{ $o->order_code}}</a>
                                            </td>
                                            <td>{{ $o->total_price}}</td>
                                            <td>
                                                <select name="status" class="form-control statusChange">
                                                    <option value="0" @if ( $o->status == 0) selected @endif>Waiting</option>
                                                    <option value="1" @if ( $o->status == 1) selected @endif>Accept</option>
                                                    <option value="2" @if ( $o->status == 2) selected @endif>Reject</option>
                                                </select>
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

            // $('#orderStatus').change(function(){

            //     $status = $('#orderStatus').val();
            //     console.log($status);

            //     $.ajax({

            //     type: 'get',
            //     url: 'http://127.0.0.1:8000/orders/ajax/status',
            //     data:{'status' : $status, },
            //     dataType: 'json' ,
            //     success:
            //         function(response) {
            //             $list = '';
            //         for($i=0;$i<response.length;$i++){
            //             $months = ['January','February','Mach','April','May','June','July','August','September','October','November','December'];
            //             $dbDate = new Date(response[$i].created_at);
            //             $finalDate = $months[$dbDate.getMonth()] +"-"+ $dbDate.getDate() +"-"+ $dbDate.getFullYear() ;

            //             if(response[$i].status == 0){
            //                 $statusMessage = `
            //                 <select name="status" class="form-control statusChange">
            //                     <option value="0" Selected>Waiting</option>
            //                     <option value="1" >Accept</option>
            //                     <option value="2" >Reject</option>
            //                 </select>
            //                 `;
            //             }else if(response[$i].status == 1){
            //                 $statusMessage = `
            //                 <select name="status" class="form-control statusChange">
            //                     <option value="0" >Waiting</option>
            //                     <option value="1" Selected>Accept</option>
            //                     <option value="2" >Reject</option>
            //                 </select> `
            //             }else if(response[$i].status == 2){
            //                 $statusMessage = `
            //                 <select name="status" class="form-control statusChange">
            //                     <option value="0" >Waiting</option>
            //                     <option value="1" >Accept</option>
            //                     <option value="2" Selected>Reject</option>
            //                 </select> `;
            //             };

            //             // append
            //             $list += `
            //             <tr class="mb-3 tr-shadow">
            //                 <td>${response[$i].user_id}</td>
            //                 <td>${response[$i].user_name}</td>
            //                 <td>${$finalDate}</td>
            //                 <td>${response[$i].order_code}</td>
            //                 <td>${response[$i].total_price}</td>
            //                 <td>${$statusMessage}</td>
            //             </tr>
            //             `;
            //             }
            //         $('#dataList').html($list);
            //          }

            //          })

            // })

            // change status
            $('.statusChange').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'status' : $currentStatus,
                    'orderId' : $orderId
                }
                $.ajax({
                    type: 'get',
                    url: '/orders/ajax/change/status',
                    data: $data,
                    dataType: 'json' ,
                })


             })

        })
    </script>
@endsection
