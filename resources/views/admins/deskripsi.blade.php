<!DOCTYPE html>
<html lang="en">
@include('components.header')
<body>
    <nav class="navbar__admin">
        <h1>Admin Page</h1>
        @auth
            <div>
                <h1>Welcome, {{ $name }}!</h1>
            </div>
        @else
            <p>Please log in to see your profile.</p>
        @endauth
    </nav>

    
</body>
</html>