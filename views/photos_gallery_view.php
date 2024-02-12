<form action="/save" method="post">
            <div class="gallery-images">
                <?php foreach ($model['photos'] as $photo):
                    $directory = 'images/';
                    $thumbnailFilePath = $directory . $photo['filename'];
                    $watermarkedFilePath = str_replace('thumb_', 'wm_', $thumbnailFilePath);
                    $photoId = (string) $photo['_id'];
                    $isChecked = in_array($photoId, $model['selected_photos'], true) ? 'checked' : '';
                ?>
                    <div>
                    <a href="<?php echo $watermarkedFilePath; ?>" target="_blank">
                        <img src="<?php echo $thumbnailFilePath; ?>" alt="<?php echo $photo['title']; ?>">
                    </a>
                        <div class="image-info">
                            <p>Title: <?php echo $photo['title']; ?></p>
                            <p>Author: <?php echo $photo['author']; ?></p>
                            <input type="checkbox" name="selected_photos[]" value="<?php echo $photoId; ?>" <?php echo $isChecked; ?>>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <input type="submit" value="Remember selected">
</form>