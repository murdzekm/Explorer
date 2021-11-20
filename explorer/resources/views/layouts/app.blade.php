<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Explorer</title>
{{--    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed mb-5">


<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <div class="container">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/">Explorer</a>

{{--    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">--}}
{{--        <a href="<?= ROOT ?>employeesController/login" class="btn btn-info">Zaloguj</a>--}}
{{--    </div>--}}

    </div>
</nav>

@yield('content')

{{--<footer class="py-2 bg-light mt-auto">--}}

{{--<div class="container-fluid px-4 ">--}}
{{--    <div class="container d-flex align-items-center text-lg-center justify-content-between small">--}}
{{--        <div class="text-muted">Copyright &copy; Your Website 2021</div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</footer>--}}

{{--<footer class="footer text-center mt-auto">--}}
<footer class="text-center navbar fixed-bottom bg-white">
    <div class="container">
            <div class=" p-2">
                Copyright &copy; Your Website 2021
            </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
{{--<script src="{{asset('js/scripts.js')}}"></script>--}}
</body>
</html>