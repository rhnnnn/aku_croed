<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/register.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>a register site you dumbass</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Register</h1>
        <form action="/register-user" method="POST">
            @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('danger') }}</div>
            @endif
            @csrf
            {{-- nama --}}
            <label for="nama">Name</label><br>
            <input type="text" name="name" value="{{ old('name') }}"><br>
            <span class="text-danger">@error('name') {{ $message }} @enderror</span><br>
            {{-- username --}}
            <label for="username">Username</label><br>
            <input type="text" name="username" value="{{ old('username') }}"><br>
            <span class="text-danger">@error('username') {{ $message }} @enderror</span><br>

            {{-- email --}}
            <label for="email">Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}"><br>
            <span class="text-danger">@error('email') {{ $message }} @enderror</span><br>

            {{-- passwd --}}
            <label for="password">Password</label><br>
            <input type="password" name="password" value="{{ old('password') }}"><br>
            <span class="text-danger">@error('password') {{ $message }} @enderror</span><br>

            {{-- button and things --}}
            <button>Register</button>
            <p> Already a user?
                <a href="/login" class="test">Login here!</a>
            </p>
        </form>
    </div>
</body>
</html>
