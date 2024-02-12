<?php
require_once 'business.php';

function login(&$model)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && isset($_POST['pass'])) {
        $login = $_POST['login'];
        $password = $_POST['pass'];
        $done = ReadUser($login, $password);

        if ($done !== true) {
            $model['message'] = "Wrong Login or Password. Try Again";
        } else {
            $_SESSION['login_success'] = true;
            header("Location: /");
            exit;
        }
    }
    return 'login_view';
}

function logout(&$model) {
    require_once 'controller_logout.php';
}

function register(&$model)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];

        if ($password === $repeat_password) {
            if (!LoginExist($login) && !EmailExist($email)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                if (AddNewUser($login, $email, $hash)) {
                    header("Location: /login");
                    exit;
                } else {
                    $model['error'] = "Error registering user.";
                }
            } else {
                $model['error'] = "Login or Email is taken. Try again";
            }
        } else {
            $model['error'] = "Passwords are not the same. Try again";
        }
    }
    return 'register_view';
}

function gallery(&$model) {
    $perPage = 3;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $galleryData = paginationLogic($page, $perPage);

    $model['photos'] = $galleryData['photos'];
    $model['pages'] = $galleryData['pages'];
    $model['currentPage'] = $galleryData['currentPage'];

    $model['selected_photos'] = $_SESSION['selected_photos'] ?? [];

    return 'gallery_view';
}

function upload(&$model)
{ 

    $model['feedback_messages'] = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES["image"])) {
        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/images/'; 
        $originalFilePath = $uploaddir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($originalFilePath, PATHINFO_EXTENSION));

        $isSizeValid = $_FILES["image"]["size"] <= 1000000;
        $isFormatValid = ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"); 

        if (!$isSizeValid && !$isFormatValid) {
            $model['feedback_messages'] = "<span class='error'> File is too large and unsupported file format. </span>";
        } else if (!$isFormatValid) {
            $model['feedback_messages'] = "<span class='error'> Unsupported file format. </span>";
        } else if (!$isSizeValid) {
            $model['feedback_messages'] = "<span class='error'> File is too large </span>";
        } 

        if (empty($model['feedback_messages'])) {
            $watermarkedFilePath = $uploaddir . 'wm_' . basename($_FILES['image']['name']);
            $thumbnailFilePath = $uploaddir . 'thumb_' . basename($_FILES['image']['name']);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $originalFilePath)) {
                $fileType = mime_content_type($originalFilePath);

                switch ($fileType) {
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($originalFilePath);
                        break;
                    case 'image/png':
                        $image = imagecreatefrompng($originalFilePath);
                        break;
                }
        
                if (isset($image)) {
                    $width = imagesx($image);
                    $height = imagesy($image);
        
                    $watermarkText = $_POST["watermark"];
                    $font = 5;
                    $white = imagecolorallocate($image, 255, 255, 255);
        
                    imagestring($image, $font, $width - 200, $height - 20, $watermarkText, $white);
        
                    switch ($fileType) {
                        case 'image/jpeg':
                            imagejpeg($image, $watermarkedFilePath);
                            break;
                        case 'image/png':
                            imagepng($image, $watermarkedFilePath);
                            break;
                    }
                    imagedestroy($image);
        
                    $thumbnailWidth = 200;
                    $thumbnailHeight = 125;
                    $thumbnail = imagecreatetruecolor($thumbnailWidth, $thumbnailHeight);

                    switch ($fileType) {
                        case 'image/jpeg':
                            $sourceImage = imagecreatefromjpeg($originalFilePath);
                            break;
                        case 'image/png':
                            $sourceImage = imagecreatefrompng($originalFilePath);
                            break;
                    }

                    imagecopyresized($thumbnail, $sourceImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $width, $height);
                    
                    switch ($fileType) {
                        case 'image/jpeg':
                            imagejpeg($thumbnail, $thumbnailFilePath);
                            break;
                        case 'image/png':
                            imagepng($thumbnail, $thumbnailFilePath);
                            break;
                    }
                    imagedestroy($thumbnail);
                    imagedestroy($sourceImage);
                    
                    $title = $_POST['title'];
                    $author = $_POST['author'];

                    PhotoData($thumbnailFilePath, $title, $author);

                    $model['feedback_messages'] = "<span class='success'>File and thumbnails uploaded successfully.</span>";
                }
            } else {
                $model['feedback_messages'] = "<span class='error'>There was a problem with the file upload. Try again.</span>";
            }
        }
    }

    return 'upload_view';
}

function save_selected_photos(&$model) {
    if (!empty($_POST['selected_photos'])) {
        if (!isset($_SESSION['selected_photos'])) {
            $_SESSION['selected_photos'] = array();
        }

        $newSelections = $_POST['selected_photos'];
        $_SESSION['selected_photos'] = array_unique(array_merge($_SESSION['selected_photos'], $newSelections));
    }

    return 'redirect:/gallery';
}

function remembered_photos(&$model) {
    $model['photos'] = [];

    if (!empty($_SESSION['selected_photos'])) {
        $selectedPhotos = $_SESSION['selected_photos'];
        $model['photos'] = getSelectedPhotos($selectedPhotos);
    }

    return 'remembered_photos_view';
}

function remove_photo(&$model) {
    if (!empty($_POST['remove_photos'])) {
        $removePhotos = $_POST['remove_photos'];
        $_SESSION['selected_photos'] = array_diff($_SESSION['selected_photos'], $removePhotos);
    }

    return 'redirect:/remembered';
}
