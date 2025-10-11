{{-- 
    WELCOME VIEW - Dashboard after successful login
    
    WHAT HAPPENS WHEN YOU CLICK LOGOUT:
    1. Form submits to POST /logout route
    2. Controller destroys the user session
    3. Redirect to /login page
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>✓ Connected to PostgreSQL</h1>
    <h2>Login Successful!</h2>
    
    <p>Welcome! You are now logged in.</p>

    <form action="/logout" method="POST" style="display: inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>