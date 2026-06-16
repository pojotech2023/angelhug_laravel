<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pojo Course Pilot - Login</title>
    <link href="{{ asset('img/logo (2).png') }}" rel="icon">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-container {
            width: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .image-column {
            background: url('https://via.placeholder.com/600x800') no-repeat center center;
            background-size: cover;
            height: 100%;
            /* background-color: #f4f4f4; */
        }
        .login-form {
            padding: 40px;
            background-color: white;
        }
       
    </style>
</head>

<body>
    <div class="login-container row">
        <!-- Left Column - Login Form -->
        <div class="col-md-6 login-form d-flex flex-column justify-content-center align-items-center">
            <div class="w-100" style="max-width: 400px;">
                <div class="w-100 text-center" style="max-width: 400px;">
    
    <h1 class="mb-4">Login</h1>
</div>

                <p style="color: rgb(104, 104, 104)">Login to access your Pojo Course Pilot account</p>
                <form action="{{ route('login.submit') }}" method="post">
                    @csrf 
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobileNumber" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobileNumber" name="mobile_no"
                         placeholder="Enter your mobile number" maxlength="10" minlength="10" pattern="[0-9]{10}" inputmode="numeric" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    
        <!-- Right Column - Image -->
        <div class="col-md-6 image-column d-none d-md-block">
            <img src="{{asset('images/login.jpg')}}">
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
