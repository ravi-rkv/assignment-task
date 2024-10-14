<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Data Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">

                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <a href="{{route('addSingle')}}" class="btn btn-dark ">Back</a>
                            </div>
                        </div>

                        <hr>
                        <h5>Edit Details</h2>

                            <form action="{{ route('updateData', $index) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">


                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $detail['name'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Password</label>
                                            <input type="text" class="form-control" name="password" value="{{ $detail['password'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $detail['email'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control" name="mobile" value="{{ $detail['mobile'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control" name="role" required>
                                                <option value="Admin" {{ $detail['role'] == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="User" {{ $detail['role'] == 'User' ? 'selected' : '' }}>User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control" name="date" value="{{ $detail['date'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" name="image" accept="image/*">
                                            @if(!empty($detail['image'] ))
                                            <img src="{{ asset($detail['image']) }}" alt="Current Image" width="100" style="margin-top: 10px;width:40px">
                                            @else
                                            <small class="text-danger">No Image</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                    </div>








                </div>
            </div>

        </div>
    </div>

    </div>

</body>

</html>
