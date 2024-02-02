<?php $__env->startSection('title', 'Products List Page'); ?>

<?php $__env->startSection('content'); ?>
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
                            <h4 class="text-secondary">Search Key : <span class="text-info"><?php echo e(request('key')); ?></span> </h4>
                        </div>

                        <div class="col-4 offset-4">
                            <form action="<?php echo e(route('admin#orderList')); ?>" method="get">
                                <?php echo csrf_field(); ?>
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Enter Orders Code... " value="<?php echo e(request('key')); ?>">
                                    <button class="btn btn-secondary" type="submit" >
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="<?php echo e(route('admin#changeStatus')); ?>" method="get" class="offset-7 col-5">
                        <?php echo csrf_field(); ?>
                        <div class="d-flex mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa-solid fa-cookie"></i><?php echo e(count($order)); ?></span>
                            </div>
                            <select name="orderStatus" class="custom-select" id="inputGroupSelect02">
                                <option value="">All</option>
                                <option value="0" <?php if(request('orderStatus') == '0'): ?> selected <?php endif; ?>>Waiting</option>
                                <option value="1" <?php if(request('orderStatus') == '1'): ?> <?php endif; ?>>Accept</option>
                                <option value="2" <?php if(request('orderStatus') == '2'): ?> <?php endif; ?>>Reject</option>
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
                                        <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="mb-3 tr-shadow">
                                            <input type="hidden" class="orderId" value="<?php echo e($o->id); ?>">
                                            <td><?php echo e($o->user_id); ?></td>
                                            <td><?php echo e($o->user_name); ?></td>
                                            <td><?php echo e($o->created_at->format('F j, Y')); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('admin#listInfo',$o->order_code)); ?>" class="text-primary"><?php echo e($o->order_code); ?></a>
                                            </td>
                                            <td><?php echo e($o->total_price); ?></td>
                                            <td>
                                                <select name="status" class="form-control statusChange">
                                                    <option value="0" <?php if( $o->status == 0): ?> selected <?php endif; ?>>Waiting</option>
                                                    <option value="1" <?php if( $o->status == 1): ?> selected <?php endif; ?>>Accept</option>
                                                    <option value="2" <?php if( $o->status == 2): ?> selected <?php endif; ?>>Reject</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scriptSection'); ?>
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
                    url: 'http://127.0.0.1:8000/orders/ajax/change/status',
                    data: $data,
                    dataType: 'json' ,
                })


             })

        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pizza_order_system\resources\views/admin/order/list.blade.php ENDPATH**/ ?>