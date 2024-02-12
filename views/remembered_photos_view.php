<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remembered Photos</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        form {
            flex-direction: column; 
            gap: 20px; 
            margin-top: 20px;
            align-items: center;
        }
        .gallery-images {
            display: flex;
            gap: 50px;
            justify-content: center;
            flex-wrap: wrap; 
        }
        img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        img:hover {
            transform: scale(1.1);
        }
        .image-info {
            margin-top: 10px;
        }
        .image-info p {
            margin: 5px 0;
            font-weight: bolder;
        }
        input[type="checkbox"] {
            margin-top: 10px;
        }
        input[type="submit"] {
            background-color: #0056b3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #004494;
        }
        .pagination {
            margin-top: 20px;
        }
        .pagination a {
            text-decoration: none;
            padding: 8px 16px;
            margin: 0 4px;
            border-radius: 5px;
            background-color: #0056b3;
            color: white;
            transition: background-color 0.3s ease;
        }
        .pagination a:hover {
            background-color: #004494;
        }
    </style>
</head>
<body>

    <nav>
        <a href="/" style="display: block; margin-top: 20px; text-align: center;">Go Back</a>
    </nav>

    <form action="/remove-photo" method="post">
        <div class="gallery-images">
        <?php foreach ($photos as $photo): ?>
            <div>
                <img src="images/<?php echo $photo['filename']; ?>" alt="<?php echo $photo['title']; ?>">
                <div class="image-info">
                    <p>Title: <?php echo $photo['title']; ?></p>
                    <p>Author: <?php echo $photo['author']; ?></p>
                    <input type="checkbox" name="remove_photos[]" value="<?php echo (string) $photo['_id']; ?>">
                </div>
            </div>
        <?php endforeach; ?>
        </div>
        <input type="submit" value="Remove selected from remembered">
    </form>
</body>
</html>