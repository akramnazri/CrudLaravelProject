<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js"
        integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container mt-3">
        <h2>View Student</h2>
        <br>
        @if (\Session::has('success'))
            <br>
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <br>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">+ Add
            New</button>
        <br><br>
        <table id="datatable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Student Id</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student as $s)
                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->StudentID }}</td>
                        <td>{{ $s->Address }}</td>
                        <td><button type="button" class="btn btn-primary edit">Edit</button>
                            <button type="button" class="btn btn-danger delete">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Student</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ action('App\Http\Controllers\StudentController@store') }}" method="POST">
                    <!-- Modal body -->
                    <div class="modal-body">


                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="student" class="form-label">Student Id:</label>
                            <input name="Student_id" class="form-control" id="student" placeholder="Enter student id">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input name="Address" class="form-control" id="address" placeholder="Enter address">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Modal Edit -->
    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Student</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST" id="editForm">
                    <!-- Modal body -->
                    <div class="modal-body">

                        @method('PUT')
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="student" class="form-label">Student Id:</label>
                            <input name="Student_id" class="form-control" id="studentE" placeholder="Enter student id">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input name="Address" class="form-control" id="addressE" placeholder="Enter address">
                        </div>
                        <div>

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- The Modal Delete -->
    <div class="modal" id="myModal3">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Student</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST" id="deleteForm">
                    <!-- Modal body -->
                    <div class="modal-body">

                        @method('DELETE')
                        @csrf
                        <p> Are You Sure?</p>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div>

    </div>
    </div>


    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#datatable').DataTable();

            // edit record
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data);

                $('#studentE').val(data[1]);
                $('#addressE').val(data[2]);

                $('#editForm').attr('action', "/student/" + data[0] + "");
                $('#myModal2').modal('show');
            })

            table.on('click', '.delete', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data);

                $('#deleteForm').attr('action', "/student/" + data[0] + "");
                $('#myModal3').modal('show');
            })
        });
    </script>

</body>

</html>
