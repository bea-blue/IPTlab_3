<?php
$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

// Handle Text File
if (!empty($_FILES['text_file']['name'])) {
    $uploaded_text_file = $upload_directory . basename($_FILES['text_file']['name']);
    $temporary_file = $_FILES['text_file']['tmp_name'];
    if (move_uploaded_file($temporary_file, $uploaded_text_file)) {
        $text_file_content = file_get_contents($uploaded_text_file);
        ?>
        <h3>Text File</h3>
        <textarea cols="70" rows="30"><?php echo htmlspecialchars($text_file_content); ?></textarea>
        <?php
    } else {
        echo 'Failed to upload text file';
    }
}

// Handle Image File
if (!empty($_FILES['image_file']['name'])) {
    $uploaded_image_file = $upload_directory . basename($_FILES['image_file']['name']);
    $temporary_image = $_FILES['image_file']['tmp_name'];
    if (move_uploaded_file($temporary_image, $uploaded_image_file)) {
        $image_relative = $relative_path . basename($_FILES['image_file']['name']);
        ?>
        <h3>Image File</h3>
        <img src="<?php echo htmlspecialchars($image_relative); ?>" style="max-width: 100%;" alt="Uploaded image" />
        <?php
    } else {
        echo 'Failed to upload image file';
    }
}