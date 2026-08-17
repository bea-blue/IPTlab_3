<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

// Handle Text File
$uploaded_text_file = $upload_directory . basename($_FILES['text_file']['name']);
$temporary_file = $_FILES['text_file']['tmp_name'];

if (move_uploaded_file($temporary_file, $uploaded_text_file)) {
    $text_file_content = file_get_contents($uploaded_text_file, 'r');
    ?>
    <textarea cols="70" rows="30"><?php echo $text_file_content; ?></textarea>
    <?php
} else {
    echo 'Failed to upload file';
}


echo '<pre>';
var_dump($_FILES);
exit;