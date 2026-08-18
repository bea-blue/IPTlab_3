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

// Handle Audio File
if (!empty($_FILES['audio_file']['name'])) {
    $uploaded_audio_file = $upload_directory . basename($_FILES['audio_file']['name']);
    $temporary_audio = $_FILES['audio_file']['tmp_name'];
    if (move_uploaded_file($temporary_audio, $uploaded_audio_file)) {
        $audio_relative = $relative_path . basename($_FILES['audio_file']['name']);
        ?>
        <h3>Audio File</h3>
        <audio controls>
            <source src="<?php echo htmlspecialchars($audio_relative); ?>" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <?php
    } else {
        echo 'Failed to upload audio file';
    }
}