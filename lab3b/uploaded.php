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