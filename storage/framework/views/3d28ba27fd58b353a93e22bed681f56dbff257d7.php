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
                        <a href="">
                            <div class="menu_img"></div> <?php echo e(Auth::user()->name); ?></a>
                    </li>
                    <li class="menu_item" id="dashboard">
                        <a href="#" class="active">
                            <div class="menu_img"><img src="<?php echo e(asset('img/Icon material-dashboard.svg')); ?>"></div>Dashboard</a>
                    </li>

                    <li class="menu_item" id="hr">
                        <a href="<?php echo e(route('admin.getAdmin')); ?>">
                            <div class="menu_img"><img src="<?php echo e(asset('img/Icon awesome-user-friends.svg')); ?>"></div>Admins</a>
                    </li>
                    <li class="menu_item" id="um">
                        <a href="<?php echo e(route('admin.getGaurd')); ?>" >
                            <div class="menu_img"><img src="<?php echo e(asset('img/Icon awesome-user-friends.svg')); ?>"></div>Guards</a>
                    </li>
                    <li class="menu_item logout"><a href="<?php echo e(route('signout')); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>
                       Logout</a></li>
                </ul>
            </sidenav>
            <main>
                <topnav>
                    <page>Dashboard</page>
                    <h5>List of Entries</h5>
                </topnav>
                <div class="btn_container"><button onclick="editProfile()">Mange parking</button></div>
                <div class="wrapper">

                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Entrance</th>
                                <th>Exit</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr>
                                <td>4</td>
                                <td>yes</td>
                                <td></td>
                                <td>
                                  12-02=2022
                                </td>
                            </tr>
                          
                        </tbody>
                    </table>

                </div>
            </main>
            <popup>
                <div class="popup_content">
                    <div class="popup_content_header" onclick="editProfile()"><i class="fas fa-times"></i></div>
                    <div class="popup_content_body">
                        <h2>Number of bays</h2>
                        <form id="f1"  enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="formControl half">
                                <label>Bays</label>
                                <input type="number" value="<?php echo e($parkingbays[0]->number_of_bays); ?>"class="inputs" name="bay" id="bay" placeholder="Number of bays" maxlength="100" required>
                            </div>
                           
        
                            <div class="popup_content_footer">
                                <button class="cancel" onclick="editProfile()">Cancel</button>
                                <button class="save" type="button">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </popup>
    </body>
  
   

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();


            $(".save").click(function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                var formData = $('#f1').serialize();

                $.ajax({
                    type: 'PATCH',
                    url: 'bayUpdate',
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
                            jQuery('.alert-success').append('<p>guard is successfully updated</p>');
                            Swal.fire(
                                'Success',
                                'bay is successfully updated',
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
        
    </script>

</html><?php /**PATH C:\Users\MOSES\projects\parkingBay\resources\views/dashboard/dashboard.blade.php ENDPATH**/ ?>