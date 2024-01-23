<?php include('server.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
    <link rel="stylesheet" href="signup-style.css">
    <style>
        /* Add your custom styles here */
        .input-class {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .input-class label {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="server.php" method="post">
            <h1>Signup</h1>
            <div class="input-class">
                <input type="text" placeholder="First name" required name="firstname">
            </div>
            <div class="input-class">
                <input type="text" placeholder="Last name" required name="lastname">
            </div>
          
            <div class="input-class">
                <input type="email" placeholder="Email" required name="email">
            </div>
            <div class="input-class">
                <input type="password" placeholder="Password" required name="password">
            </div>
            <div class="input-class">
                <input type="tel" placeholder="Phone number" required name="Phone">
            </div>
            <div class="input-class">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" placeholder="Age" min="18" max="99" required name="age">
            </div>
            <div class="input-class">
                <label><input type="radio" name="gender" value="male" required name="m"> Male</label>
                <label><input type="radio" name="gender" value="female" required name="f"> Female</label>
            </div>
            <div class="login-link">
                <button type="submit" class="btn">Signup</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
