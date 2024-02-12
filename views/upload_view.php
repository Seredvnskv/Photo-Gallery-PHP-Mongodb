<!DOCTYPE html>
<html>
<head>
    <title>Photo Upload Form</title>
    <style>
        body  {
            font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
            background-color: #f4f4f4;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        header {
            text-align: center;
        }
        nav {
            text-align: center;
            width: 100%;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .form-div {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 85vh;
        }
        .upload-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
        }
        .form-field {
            margin-bottom: 15px;
        }
        .form-field label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-field input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            cursor: pointer;
        }
        .form-field input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-field input[type="submit"] {
            width: 100%;
            background-color: #0056b3;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-field input[type="submit"]:hover {
            background-color: #004494;
        }
        .feedback {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #333;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <header> 
        <h1>Photo Gallery</h1>
    </header>

    <nav>
        <?php include 'menu_view.php'; ?>
    </nav>
    
    <?php include 'login_alert.php'; ?>

    <div class="form-div">
        <form class="upload-form" method="post" enctype="multipart/form-data">
            
            <h2>Upload Your Image</h2>

            <div class="form-field">
                <label for="image">Select image to upload:</label>
                <input type="file" id="image" name="image" >
            </div>

            <div class="form-field">
                <label for="watermark">Watermark Text:</label>
                <input type="text" id="watermark" name="watermark" required>
            </div>

            <div class="form-field">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-field">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
            </div>

            <div class="form-field">
                <input type="submit" value="Upload Image">
            </div>

            <div class="feedback">
                <?php echo $model['feedback_messages'] ?? ''; ?>
            </div>
        </form>
    </div>

</body>
</html>