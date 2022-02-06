<!doctype html>

<title>My blog</title>
<link rel="stylesheet" href="/app.css">

<body>

<div style="margin-top: 30px">
    @if(session()->has('success'))
        <div style="color: green">
            <p>{{ session('success') }}</p>
        </div>
    @endif

        @auth
            <span>Welcome, {{ auth()->user()->name }}!</span>

            <form method="POST" action="/logout">
                @csrf

                <button type="submit">Log Out</button>
            </form>
        @else
            <a href="/register">Register</a>
            <a href="/login">Log In</a>
        @endauth
</div>



    <?php foreach ($posts as $post) : ?>
        <article>
            <?= $post ?>
        </article>

    <?php endforeach; ?>

</body>
