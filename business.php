<?php

use MongoDB\BSON\ObjectID;

function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function LoginExist($login) {
    $db = get_db(); 
    $query = ['login' => $login];
    $user = $db->users->findOne($query);
    if ($user) { 
        return true;
    } else {
        return false;
    }
}

function EmailExist($email) {
    $db = get_db();
    $query = ['email' => $email];
    $user = $db->users->findOne($query);
    if ($user) {
        return true;
    } else {
        return false;
    }
}

function AddNewUser($login, $email, $password) {
    $db = get_db(); 
    $info = $db->users->insertOne(['login' => $login, 'email' => $email, 'password'=> $password]);
    return $info;
}

function PhotoData($thumbnailFilePath, $title, $author) {
    $db = get_db();
    
    $data = [
        'filename' => basename($thumbnailFilePath),
        'title' => $title,
        'author' => $author,
    ];

    $result = $db->photos->insertOne($data);

    return $result;
}

function ReadUser($login, $password){
    try {
    $db = get_db();
    $user = $db->users->findOne(['login' => $login]);
    if($user !== null && password_verify($password,
    $user['password'])){
    session_regenerate_id();
    $_SESSION['user_id'] = $user['_id'];
    return true;
    }
    else { return false; }
    }
    catch( Exception $e) { return $e; }
}

function getSelectedPhotos($selectedPhotoIds) {
    $db = get_db();
    $photos = [];

    foreach ($selectedPhotoIds as $photoId) {
        $photos[] = $db->photos->findOne(['_id' => new MongoDB\BSON\ObjectId($photoId)]);
    }

    return $photos;
}

function paginationLogic($page, $perPage) {
    $db = get_db();
    
    $totalPhotos = $db->photos->count();
    $pages = ceil($totalPhotos / $perPage);
    $skip = ($page - 1) * $perPage;
    $photos = $db->photos->find([], ['limit' => $perPage, 'skip' => $skip]);

    return [
        'photos' => $photos,
        'pages' => $pages,
        'currentPage' => $page
    ];
}