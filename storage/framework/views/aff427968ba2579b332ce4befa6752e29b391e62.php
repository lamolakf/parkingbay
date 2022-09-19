<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
        />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" href="<?php echo e(asset('css/nae.css')); ?>">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title></title>
    </head>

    <body>
        
        <div class="containerx">
            <sidenav class="h-100">
                <ul class="menu">
                    <li class="menu_item branding">
                        <a href="">
                            <div class="brand_img"><img src="img/Group 3454.svg.png"></div>
                         
                        </a>
                    </li>

                    <li class="menu_item" id="dashboard">
                        <a href="#">
                            <div class="menu_img"></div> <?php echo e(Auth::user()->name); ?></a>
                    </li>
                    <li class="menu_item" id="dashboard">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <div class="menu_img"><img src="<?php echo e(asset('img/Icon material-dashboard.svg')); ?>"></div>Dashboard</a>
                    </li>

                    <li class="menu_item" id="hr">
                        <a href=""  class="active">
                            <div class="menu_img"><img src="<?php echo e(asset('img/Icon awesome-user-friends.svg')); ?>"></div>Admins</a>
                    </li>
                    <li class="menu_item" id="um">
                        <a href="<?php echo e(route('admin.getGaurd')); ?>">
                            <div class="menu_img"><img src="<?php echo e(asset('img/Icon awesome-user-friends.svg')); ?>"></div>Guards</a>
                    </li>
                    <li class="menu_item logout"><a href="<?php echo e(route('signout')); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>
                       Logout</a></li>
                </ul>
            </sidenav>
            <main>
                <topnav>
                    <page>Dashboard</page>

                </topnav>
                <div class="btn_container"><button onclick="editProfile()">Add New Admin</button></div>
                <div class="wrapper">

                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($security_guards->count()): ?>
                            <?php
                              $edit;
                              
                            ?>
                            <?php $__currentLoopData = $security_guards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($g->name); ?></td>
                                <td><?php echo e($g->lastName); ?></td>
                                <td><?php echo e($g->email); ?></td>
                                <td>
                                    <a href="http://"><i class="fas fa-eye"></i></a> |
                                    <a href="http://"><i class="fas fa-trash"></i></a> 
                                   
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </main>
    </body>
    <popup>
        <div class="popup_content">
            <div class="popup_content_header" onclick="editProfile()"><i class="fas fa-times"></i></div>
            <div class="popup_content_body">
                <h2>Add New admin</h2>
                <div style="color: red" id="editfeed">

                </div>
                <form method="POST" id="f1" action="" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="formControl half">
                        <label>Name</label>
                        <input class="inputs" name="name" id="name" placeholder="Name" maxlength="100" required>
                    </div>
                    <div class="formControl half">
                        <label>Last Name</label>
                        <input type="text" class="inputs" name="lastName" id="lastName" placeholder="Last Name" maxlength="100" required>
                    </div>

                    <div class="formControl half">
                        <label>Email</label>
                        <input type="email" class="inputs" name="email" id="email" placeholder="Email" maxlength="100" required>
                    </div>

                    <div class="popup_content_footer">
                        <button class="cancel" onclick="editProfile()">Cancel</button>
                        <button class="save" type="button">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </popup>

    <popup>
        <div class="popup_content">
            <div class="popup_content_header" onclick="fg()"><i class="fas fa-times"></i></div>
            <div class="popup_content_body">
                <h2>Fingerprint</h2>
                <div class="wrapper">
                    <center>
                      <svg xmlns="http://www.w3.org/2000/svg"
                      style="height: 100;" 
                      viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                      <path d="M256.1 246c-13.25 0-23.1 10.75-23.1 23.1c1.125 72.25-8.124 141.9-27.75 211.5C201.7 491.3 206.6 512 227.5 512c10.5 0 20.12-6.875 23.12-17.5c13.5-47.87 30.1-125.4 29.5-224.5C280.1 256.8 269.4 246 256.1 246zM255.2 164.3C193.1 164.1 151.2 211.3 152.1 265.4c.75 47.87-3.75 95.87-13.37 142.5c-2.75 12.1 5.624 25.62 18.62 28.37c12.1 2.625 25.62-5.625 28.37-18.62c10.37-50.12 15.12-101.6 14.37-152.1C199.7 238.6 219.1 212.1 254.5 212.3c31.37 .5 57.24 25.37 57.62 55.5c.8749 47.1-2.75 96.25-10.62 143.5c-2.125 12.1 6.749 25.37 19.87 27.62c19.87 3.25 26.75-15.12 27.5-19.87c8.249-49.1 12.12-101.1 11.25-151.1C359.2 211.1 312.2 165.1 255.2 164.3zM144.6 144.5C134.2 136.1 119.2 137.6 110.7 147.9C85.25 179.4 71.38 219.3 72 259.9c.6249 37.62-2.375 75.37-8.999 112.1c-2.375 12.1 6.249 25.5 19.25 27.87c20.12 3.5 27.12-14.87 27.1-19.37c7.124-39.87 10.5-80.62 9.749-121.4C119.6 229.3 129.2 201.3 147.1 178.3C156.4 167.9 154.9 152.9 144.6 144.5zM253.1 82.14C238.6 81.77 223.1 83.52 208.2 87.14c-12.87 2.1-20.87 15.1-17.87 28.87c3.125 12.87 15.1 20.75 28.1 17.75C230.4 131.3 241.7 130 253.4 130.1c75.37 1.125 137.6 61.5 138.9 134.6c.5 37.87-1.375 75.1-5.624 113.6c-1.5 13.12 7.999 24.1 21.12 26.5c16.75 1.1 25.5-11.87 26.5-21.12c4.625-39.75 6.624-79.75 5.999-119.7C438.6 165.3 355.1 83.64 253.1 82.14zM506.1 203.6c-2.875-12.1-15.51-21.25-28.63-18.38c-12.1 2.875-21.12 15.75-18.25 28.62c4.75 21.5 4.875 37.5 4.75 61.62c-.1249 13.25 10.5 24.12 23.75 24.25c13.12 0 24.12-10.62 24.25-23.87C512.1 253.8 512.3 231.8 506.1 203.6zM465.1 112.9c-48.75-69.37-128.4-111.7-213.3-112.9c-69.74-.875-134.2 24.84-182.2 72.96c-46.37 46.37-71.34 108-70.34 173.6l-.125 21.5C-.3651 281.4 10.01 292.4 23.26 292.8C23.51 292.9 23.76 292.9 24.01 292.9c12.1 0 23.62-10.37 23.1-23.37l.125-23.62C47.38 193.4 67.25 144 104.4 106.9c38.87-38.75 91.37-59.62 147.7-58.87c69.37 .1 134.7 35.62 174.6 92.37c7.624 10.87 22.5 13.5 33.37 5.875C470.1 138.6 473.6 123.8 465.1 112.9z"/></svg>
                    </center>
               
            </div>
            </div>
        </div>
    </popup>



    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function editProfile() {
            if (document.getElementsByTagName("popup")[0].style.display == "block") {
                document.getElementsByTagName("popup")[0].style.display = "none";
            } else {
                document.getElementsByTagName("popup")[0].style.display = "block";
            }
        }

        function fg() {
            if (document.getElementsByTagName("popup")[1].style.display == "block") {
                document.getElementsByTagName("popup")[1].style.display = "none";
            } else {
                document.getElementsByTagName("popup")[1].style.display = "block";
            }
        }

        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            document.getElementById('img_name').textContent = fileName;
            // Inside find search element where the name should display (by Id Or Class)
        });

        function filter(x) {
            console.log(x.value);
            var value = x.value.toLowerCase();
            $("#tbody a").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }


        jQuery(document).ready(function($) {

            $('#example').DataTable(
                /* {
                  "dom": '<"dt-buttons"Bf><"clear">lirtp',
                  "paging": false,
                  "autoWidth": true,
                  "columnDefs": [
                    { "orderable": false, "targets": 5 }
                  ],
                  "buttons": [
                    'colvis',
                    'copyHtml5',
                    'csvHtml5',
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                  ]
                } */
            );

            $(".save").click(function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                var formData = $('#f1').serialize();

                $.ajax({
                    type: 'POST',
                    url: 'admin',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('.alert-danger').html("");
                        jQuery('.alert-success').html("");
                        jQuery('#editfeed').html("");
                        jQuery.each(data.errors, function(key, value) {

                            jQuery('.alert-danger').show();
                            jQuery('.alert-success').hide();
                            jQuery('.alert-danger').append('<p>' + value + '</p>');
                            jQuery('#editfeed').append('<p>' + value + '</p>');
                        });

                        if (data.hasOwnProperty('success')) {
                            jQuery('.alert-danger').hide();
                            jQuery('.alert-success').show();
                            jQuery('.alert-success').append('<p>Record is successfully added</p>');
                            document.getElementById('f1').reset();
                            Swal.fire(
                                'success',
                                'admin is successfully updated',
                                'Success'
                            )
                            location.reload(true)
                        };

                    },
                    error: function(data) {
                        console.log("error", data);
                    }
                });
            });

            $(".update").click(function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                var formData = $('#editf1').serialize();

                $.ajax({
                    type: 'PATCH',
                    url: 'admin',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('#addfeed').html("");
                        jQuery('.alert-success').html("");
                        jQuery.each(data.errors, function(key, value) {

                            jQuery('.alert-danger').show();
                            jQuery('.alert-success').hide();
                            jQuery('#editfeed').append('<p>' + value + '</p>');
                        });

                        if (data.hasOwnProperty('success')) {
                            jQuery('.alert-danger').hide();
                            jQuery('.alert-success').show();
                            jQuery('.alert-success').append('<p>admin is successfully updated</p>');
                            Swal.fire(
                                'Success',
                                'admin is successfully updated',
                                'Success'
                            )
                            document.getElementById('editf1').reset();
                            location.reload(true)
                        };

                    },
                    error: function(data) {
                        console.log("error", data);
                    }
                });
            });

        });
    </script>

</html><?php /**PATH C:\Users\MOSES\projects\parkingBay\resources\views/admin/admin.blade.php ENDPATH**/ ?>