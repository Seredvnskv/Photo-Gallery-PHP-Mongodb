<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 350px;
            margin: auto;
        }
        label, input {
            display: block;
            width: 80%;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #0056b3;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #004494;
        }
        nav {
            margin-bottom: 20px; 
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/" style="display: block; margin-top: 20px; text-align: center;">Go Back</a>
    </nav>

    <form action="/register" method="post">

        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="repeat_password">Repeat Password:</label>
        <input type="password" id="repeat_password" name="repeat_password" required><br>

        <input type="submit" value="Register">

        <?php if (isset($model['error'])): ?>
            <span class='error'><?php echo $model['error']; ?></span>
        <?php endif; ?>
    </form>
</body>
</html>
