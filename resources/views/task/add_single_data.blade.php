<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                                <a href="/" class="btn btn-dark ">Back</a>
                            </div>
                        </div>

                        <hr>
                        <h5>Add Details</h2>
                            <form action="{{ route('addData') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-3 mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-3 mb-3">
                                        <label for="password" class="form-label">Password:</label>
                                        <input type="text" class="form-control" id="password" name="password" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-3 mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-3 mb-3">
                                        <label for="image" class="form-label">Image:</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                    </div>

                                    <!-- Mobile -->
                                    <div class="col-md-3 mb-3">
                                        <label for="mobile" class="form-label">Mobile Number:</label>
                                        <input type="tel" class="form-control" id="mobile" name="mobile" required>
                                    </div>

                                    <!-- Date -->
                                    <div class="col-md-3 mb-3">
                                        <label for="date" class="form-label">Date:</label>
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>

                                    <!-- Role -->
                                    <div class="col-md-3 mb-3">
                                        <label for="role" class="form-label">Role:</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="">Select</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </div>
                                </div>
                            </form>


                            <div class="col-lg-12">
                                <h5>Data List</h5>
                            </div>

                            @if ($details && count($details) > 0)
                            <form action="{{ route('finalSubmit') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success mb-3">Final Submit to Database</button>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Role</th>
                                        <th>Image</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $index => $detail)
                                    <tr>
                                        <td>{{ $detail['name'] }}</td>
                                        <td>{{ $detail['email'] }}</td>
                                        <td>{{ $detail['mobile'] }}</td>
                                        <td>{{ $detail['role'] }}</td>
                                        <td>
                                            @if(!empty($detail['image']))
                                            <img src="{{ asset($detail['image']) }}" alt="Image" width="100" style="width: 40px;">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>{{ $detail['date'] }}</td>
                                        <td>
                                            <a href="{{ route('editData', $index) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('deleteData', $index) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p>No details found in the session.</p>
                            @endif



                    </div>
                </div>

            </div>
        </div>

    </div>

</body>

</html>
