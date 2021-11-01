<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('includes.style')
    <title>Document</title>
</head>

<body>
    @include('includes.navbar')

    @yield('content')

    <footer>
        <div class="container sticky-top">
            <div class="row">
                <p class="text-center">Copyright&copyMuhamad Aditya</p>
            </div>
        </div>
    </footer>

</body>

@include('includes.script')

</html>