<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Product List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>

<body class="antialiased">

    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Abans Products</a>
            <ul class="navbar-nav">
               
                <li class="nav-item"><a class="nav-link" href="/home">Enter Products</a></li> 
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger mt-2 mt-lg-0">Logout</button>
                    </form>
                </li>
            </ul>

        </div>
    </nav>
    <div class="container">
        <div class="">
            <h1>Welcome {{ Auth::user()->name }}</h1>

            <table class="table" id="productsTable">
                <thead>
                    <tr>
                        <th scope="col">Product Code</th>
                        <th scope="col">Products Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
    integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>

<script type="text/javascript">
$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#productsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('getData') }}",
            "type": "POST",
            "error": function(xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        },
        "columns": [{
                "data": "product_code"
            },
            {
                "data": "product_name"
            },
            {
                "data": "quantity"
            },
            {
                "data": "unit_price"
            },
            {
                data: null,
                render: function(data, type, row) {
                    if (row.image_path !== null && typeof row.image_path !== 'undefined') {
                    var realpath=row.image_path.replace('public/', '');
                    var imageUrl = "{{ asset('storage') }}" + '/' + realpath;
                    return '<img src="' + imageUrl + '" width="100px" height="200px" />';
                    }else{
                        return 'Image not available';
                    }
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<button class="btn btn-primary edit-btn" data-id="' + row
                        .id +
                        '" > Edit </button> <button class="btn btn-danger delete-btn" data-id="' +
                        row
                        .id + '" > Delete </button>';
                }
            },
        ],
        drawCallback: function(settings) {
            $('.delete-btn').on('click', function() {
                var recordId = $(this).data('id');

                // Confirm the deletion with the user (you can use a custom modal or JavaScript's confirm function)
                var confirmation = confirm('Are you sure you want to delete this record?');

                if (confirmation) {
                    // Send an AJAX request to delete the record
                    $.ajax({
                        url: "{{ route('destroyProducts') }}", // Replace with your delete route
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: recordId
                        },
                        success: function(response) {
                            // Refresh the DataTable to reflect the updated data
                            $('#productsTable').DataTable().ajax
                                .reload();
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors here
                        }
                    });
                }
            });

            $('.edit-btn').on('click', function() {
                var recordId = $(this).data('id');
                window.location = '/editProducts/' + recordId;
            });
        },
        "paging": true,
        "pageLength": 10
    });

});
</script>