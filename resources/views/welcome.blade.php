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
       
        <link rel="stylesheet" href="{{ asset('css/nae.css') }}">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title></title>
    </head>

    <body>
        {{-- @isset($error)
        <div class="notice_error" id="notice_error">
            <div>
                <span onclick="this.parentNode.parentNode.style.display='none';"><i class="fas fa-times"></i></span>
                <p>{{ $error }}</p>
            </div>
        </div>
        @endif @isset($success)
        <div class="notice_success" id="notice_success">
            <div>
                <span onclick="this.parentNode.parentNode.style.display='none';"><i class="fas fa-times"></i></span>
                <p>{{ $success }}</p>
            </div>
        </div>
        @endif --}}
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
                            <div class="menu_img"><img src="{{ asset('img/Icon material-dashboard.svg') }}"></div>Dashboard</a>
                    </li>

                    <li class="menu_item" id="hr">
                        <a href="">
                            <div class="menu_img"><img src="{{ asset('img/Icon awesome-user-friends.svg') }}"></div>Admins</a>
                    </li>
                    <li class="menu_item" id="um">
                        <a href="" class="active">
                            <div class="menu_img"><img src="{{ asset('img/Icon awesome-user-friends.svg') }}"></div>Guards</a>
                    </li>
                    <li class="menu_item logout"><a href=""><i class="fa fa-sign-out" aria-hidden="true"></i>
                       Logout</a></li>
                </ul>
            </sidenav>
            <main>
                <topnav>
                    <page>Guard Management</page>

                </topnav>
                <div class="btn_container"><button onclick="editProfile()">Add New Guard</button></div>
                <div class="wrapper">

                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Last name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </main>
    </body>
    <popup>
        <div class="popup_content">
            <div class="popup_content_header" onclick="editProfile()"><i class="fas fa-times"></i></div>
            <div class="popup_content_body">
                <h2>Add New Guard</h2>
                <form method="POST" id="f1" action="" enctype="multipart/form-data">
                    @csrf
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
                    url: 'guard',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('.alert-danger').html("");
                        jQuery('.alert-success').html("");
                        jQuery.each(data.errors, function(key, value) {

                            jQuery('.alert-danger').show();
                            jQuery('.alert-success').hide();
                            jQuery('.alert-danger').append('<p>' + value + '</p>');
                        });

                        if (data.hasOwnProperty('success')) {
                            jQuery('.alert-danger').hide();
                            jQuery('.alert-success').show();
                            jQuery('.alert-success').append('<p>Record is successfully added</p>');
                            document.getElementById('f1').reset();
                        };

                    },
                    error: function(data) {
                        console.log("error", data);
                    }
                });
            });



        });
    </script>

</html>