<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">


    <title>Larvel AJAX CRUD</title>
</head>

<body>
    <h1 class="text-center">Larvel AJAX CRUD</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary m-4 Addmodal" data-bs-toggle="modal" data-bs-target="#datamodal">
        Insert Employee Data
    </button>

    <!-- Modal -->
    <div class="modal fade" id="datamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="form-id">
                        <div class="d-flex row">
                            <div class="mb-3 col-md-6">
                                <label for="fullname" class="fw-bold">Full Name</label>
                                <input type="text" name="fullname" id="fullname" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="fw-bold">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="d-flex row">

                            <div class="mb-3 col-md-6">
                                <label for="phone" class="fw-bold">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="mb-1 fw-bold">Gender</label>
                                <div class="d-flex">
                                    <div class="form-check me-2">
                                        <input class="form-check-input gender" type="radio" name="gender" id="male"
                                            value="male" >
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input gender" type="radio" name="gender" id="female"
                                            value="female">
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex row">
                            <div class="mb-3 col-md-6">
                                <label for="hobby" class="mb-1 fw-bold">Hobby</label>

                                <div class="form-check">
                                    <input class="form-check-input hobby" type="checkbox" value="Travel" id="travel"
                                        name="hobby[]">
                                    <label class="form-check-label" for="travel">
                                        Travel
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input hobby" type="checkbox" value="Sports" id="sports"
                                        name="hobby[]" checked>
                                    <label class="form-check-label" for="sports">
                                        Sports
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input hobby" type="checkbox" value="Music" id="music"
                                        name="hobby[]">
                                    <label class="form-check-label" for="music">
                                        Music
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="course" class="mb-1 fw-bold">Course</label>
                                <select class="form-select course" aria-label="Default select example" name="course">
                                    <option selected value="Laravel">Laravel</option>
                                    <option value="Vue JS">Vue JS</option>
                                    <option value="Java Spring">Java Spring</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="profile_image" class="mb-1 fw-bold">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="id">
                            <button type="button" class="btn btn-secondary closeModel"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary" id="save">Add Data</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="m-5">
        {{-- Table --}}
        <table class="table table-bordered pt-4" id="dataTables">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Hobby</th>
                    <th scope="col">Course</th>
                    <th scope="col">Profile Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    {{-- <script src="{{asset('js/custom.js')}}"></script> --}}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('.Addmodal').on('click', function () {
                $('#form-id')[0].reset();
                $('#id').val('');
            })
            $('#dataTables').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('employee') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    }, {
                        data: 'fullname',
                        name: 'fullname'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'hobby',
                        name: 'hobby'
                    },
                    {
                        data: 'course',
                        name: 'course'
                    },
                    {
                        data: 'profile_image',
                        name: 'profile_image'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ]
            });

            // Insert
            $("#form-id").on('submit', function (e) {
                e.preventDefault();
                if ($('#id').val() == '') {
                    var url = "{{route('store')}}";
                } else {
                    var url = "{{route('update')}}";
                }

                let formData = new FormData(this);
                $.ajax({
                    url: "{{route('store')}}",
                    type: "post",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status = 1) {
                            $('.closeModel').click();
                            $('#dataTables').DataTable().draw();
                        }
                    }
                });
            });

            // Edit
            $(document).on('click', '.edit', function () {
                var id = $(this).attr('data-id');

                $.ajax({
                    url: "{{route('edit')}}",
                    type: "get",
                    data: {
                        id: id
                    
                    },
                    success: function (response) {

                        $('.Addmodal').click();
                        $('#fullname').val(response.fullname);
                        $('#email').val(response.email);
                        $('#phone').val(response.phone);
                        $('input[name="gender"]:checked').val();
                        $('.hobby').val(response.hobby);
                        $('.course').val(response.course);
                        $('#id').val(response.id);
                    }
                })
            });

            // Delete
            $(document).on('click', '.delete', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('delete')}}",
                    type: "post",
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#dataTables').DataTable().draw();
                    }
                })
            });

        });

    </script>



</body>

</html>
