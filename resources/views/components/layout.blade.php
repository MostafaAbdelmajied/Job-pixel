<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Document</title>
</head>
<body class="bg-black text-white">
    <div class="px-10">

        <nav class="flex justify-between items-center py-4 border-b border-white/10">
            <div>
                <a href="/">
                    <img src="{{Vite::asset('resources/images/logo.svg')}}" alt="">
                </a>
            </div>
            <div class="space-x-6 font-bold">
                <a href="#">jobs</a>
                <a href="#">Careers</a>
                <a href="#">Salaries</a>
                <a href="#">Companies</a>
            </div>
            @auth

            <div class="space-x-6 font-bold flex">
                <a href="/jobs/create">post a job</a>
                    <form action="/logout" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">logout</button>
                    </form>
            </div>
            @endauth
            @guest
                <div>
                    <a class='mr-5' href="/register">Sign Up</a>
                    <a href="/login">Log In</a>
                </div>
            @endguest
        </nav>
        <main>
            {{$slot}}
        </main>
    </div>
</body>
</html>