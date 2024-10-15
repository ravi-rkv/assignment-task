<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
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
                                <a href="/addSingle" class="btn btn-info ">Add Data</a>
                                <button class="btn btn-dark " data-bs-toggle="modal" data-bs-target="#bulkUploadModal">Upload Bulk Data</button>
                                <a href="/downloadAllData" class="btn btn-dark ">Download Data</a>
                            </div>
                        </div>

                        <div class="modal fade" id="bulkUploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Bulk Upload Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row">
                                            <form action="{{ route('uploadBulkFile') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="">File data <span><small class="text-danger"><a href="{{ asset('bulkFile.csv') }}">Download sample file</a></small></span></label>
                                                        <input type="file" name="file" id="" class="form-control" required>
                                                        <span><small class="text-danger">Only CSV & XLSX file supported</small></span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-lg-12 mt-2 text-center">
                                                    <button type="submit" class="btn btn-success">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <h5>Data List</h5>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Role</th>
                                        <th>Image</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataList as $data)
                                    <tr>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->mobile }}</td>
                                        <td>{{ $data->role }}</td>
                                        <td>
                                            @if($data->image)
                                            <img src="{{ asset($data->image) }}" alt="{{ $data->name }}" width="50">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>{{ $data->date }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>

</body>

</html>