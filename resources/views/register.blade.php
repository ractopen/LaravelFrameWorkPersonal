{{-- 
    REGISTER VIEW - Create new account
    
    WHAT HAPPENS WHEN YOU CLICK REGISTER:
    1. Form submits to POST /register route
    2. Controller checks if username already exists in PostgreSQL
    3. If username exists → Show error "User already exists"
    4. If username is new → Save password as plain text to database
    5. Redirect to /login page
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register New Account</h1>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="/register" method="POST">
        @csrf
        
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        
        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="/login">Login here</a></p>
</body>
</html>