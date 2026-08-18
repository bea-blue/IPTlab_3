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

// Handle Video File
if (!empty($_FILES['video_file']['name'])) {
    $uploaded_video_file = $upload_directory . basename($_FILES['video_file']['name']);
    $temporary_video = $_FILES['video_file']['tmp_name'];
    if (move_uploaded_file($temporary_video, $uploaded_video_file)) {
        $video_relative = $relative_path . basename($_FILES['video_file']['name']);
        ?>
        <h3>Video File</h3>
        <video width="480" controls>
            <source src="<?php echo htmlspecialchars($video_relative); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <?php
    } else {
        echo 'Failed to upload video file';
    }
}