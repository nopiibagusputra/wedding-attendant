<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('/assets_login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ url('/assets_login/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/assets_login/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ url('/assets_login/css/style.css') }}">

    <title>Login</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ url('/assets_login/images/undraw_remotely_2j6y.svg') }}"
                        alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In</h3>
                                <p class="mb-4">Aplikasi Buku Induk Siswa <br>SMA Negeri 19 Surabaya</p>
                            </div>
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger fade show">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $error }}</strong>
                                </div>
                            @endforeach
                            <form action="{{ route('auth_login') }}" method="POST">
                                @csrf
                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="email" id="username">

                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>

                                <input type="submit" value="Log In" class="btn btn-block btn-primary">

                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="{{ url('/assets_login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('/assets_login/js/popper.min.js') }}"></script>
    <script src="{{ url('/assets_login/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/assets_login/js/main.js') }}"></script>
</body>

</html>
