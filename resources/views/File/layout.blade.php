<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Default Title')</title>
    <!-- Include your CSS or other head elements here -->
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <!-- Include your JavaScript or other body elements here -->
</body>
</html>
