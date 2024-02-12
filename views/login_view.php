<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="password"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #0056b3;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #004494;
        }
        nav {
            padding: 10px 0;
            text-align: center;
            width: 100%;
            position: fixed; 
            top: 0;
            left: 0;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

    <nav>
        <a href="/" style="display: block; margin-top: 20px; text-align: center;">Go Back</a>
    </nav>

    <form action="/login" method="post">
        <label for="login">Login:</label><br>
        <input type="text" name="login" required /><br />
        <label for="pass">Password:</label><br>
        <input type="password" name="pass" required /><br />
        <input type="submit" value="Submit">
        <?php if (isset($model['message'])): ?>
            <p class="error-message"><?= $model['message'] ?></p>
        <?php endif; ?>
    </form>
</body>
</html>