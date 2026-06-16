<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PojoCoursePilot - Import</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>
<body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <form class="was-validated  d-flex justify-content-center align-items-center flex-column mt-5 p-5" action="{{route('upload')}}"  enctype="multipart/form-data" method="POST">
        @csrf
        <div class="mb-3">
            <label for="validationTextarea" class="form-label fs-4 ">Bank Name:</label>
            <input type="text" class="form-control is-invalid" id="validationTextarea" placeholder="Enter bank name" required name="bank"></input>
          </div>

          <div class="mb-3">
            <input type="file" class="form-control" aria-label="file example" required name="excel_file">
            <div class="invalid-feedback">Please Choose a file</div>
          </div>
          <div class="mb-3">
            <button class="btn btn-primary" type="submit">Import</button>
            <a href="{{route('products.index')}}" class="btn btn-success">Back</a>
          </div>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>
