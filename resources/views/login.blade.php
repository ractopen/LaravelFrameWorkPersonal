{{-- 
    LOGIN VIEW - Authenticate existing user
    
    WHAT HAPPENS WHEN YOU CLICK LOGIN:
    1. Form submits to POST /login route
    2. Controller searches PostgreSQL for user with this username
    3. If username not found → Show error "Invalid credentials"
    4. If username found → Compare plain text password
    5. If password wrong → Show error "Invalid credentials"
    6. If password correct → Create session and redirect to / (welcome page)
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="/login" method="POST">
        @csrf
        
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="/register">Register here</a></p>
</body>
</html>