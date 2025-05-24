<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Hangout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="{{ asset('template/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/backend/css/app.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />
    <script src="{{ asset('template/backend/js/config.js') }}"></script>
</head>

<body class="authentication-bg">
    <div class="account-pages my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-6 p-4">
                                    <div class="mx-auto">
                                        <a href="index.html">
                                            <img src="assets/images/logo-dark.png" alt="" height="24" />
                                        </a>
                                    </div>

                                    <h6 class="h5 mb-0 mt-3">Welcome back!</h6>
                                    <p class="text-muted mt-1 mb-4">
                                        Enter your email address and password to access admin panel.
                                    </p>

                                    <form action="{{ route('login.process') }}" method="POST"
                                        class="authentication-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="icon-dual" data-feather="user"></i>
                                                </span>
                                                <input type="text" class="form-control" name="username"
                                                    placeholder="Enter username" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="icon-dual" data-feather="lock"></i>
                                                </span>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Enter your password" required>
                                            </div>
                                        </div>

                                        <div class="mb-3 text-center d-grid">
                                            <button class="btn btn-primary" type="submit">Log In</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/backend/js/vendor.min.js') }}"></script>
    <script src="{{ asset('template/backend/js/app.js') }}"></script>
</body>

</html>
