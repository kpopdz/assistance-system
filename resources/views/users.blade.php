<!DOCTYPE html>

<html>

<head>

    <title>How to Use Yajra Datatables in Laravel 9? - Nicesnippets.com</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

</head>

<body>



<div class="container">

    <h3 class="text-center mt-3 mb-4">How to Use Yajra Datatables in Laravel 9? - Nicesnippets.com</h3>

    <table class="table table-bordered data-table">

        <thead>

            <tr>

                <th>No</th>

                <th>Name</th>

                <th>Email</th>

                <th width="100px" class="text-center">Action</th>

            </tr>

        </thead>

        <tbody>

        </tbody>

    </table>

</div>



</body>



<script type="text/javascript">

  $(function () {



    var table = $('.data-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('users.datatable') }}",


        columns: [

            {data: 'id', name: 'id'},

            {data: 'name', name: 'name'},

            {data: 'email', name: 'email'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });



  });

</script>

</html>

