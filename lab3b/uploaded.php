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

// Handle PDF File
if (!empty($_FILES['pdf_file']['name'])) {
    $uploaded_pdf_file = $upload_directory . basename($_FILES['pdf_file']['name']);
    $temporary_pdf = $_FILES['pdf_file']['tmp_name'];
    if (move_uploaded_file($temporary_pdf, $uploaded_pdf_file)) {
        $pdf_relative = $relative_path . basename($_FILES['pdf_file']['name']);
        ?>
        <h3>PDF File</h3>
        <iframe src="<?php echo htmlspecialchars($pdf_relative); ?>" width="100%" height="600px">
            This browser does not support PDFs. Please download the PDF to view it:
            <a href="<?php echo htmlspecialchars($pdf_relative); ?>">Download PDF</a>
        </iframe>
        <?php
    } else {
        echo 'Failed to upload PDF file';
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