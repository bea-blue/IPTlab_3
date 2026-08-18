<?php
// from the $_SERVER global variable, check if the HTTP method used is POST, if its not POST, redirect to the index.php page
// Reference: https://www.php.net/manual/en/reserved.variables.server.php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    // BUG FIX: header() alone doesn't stop the script from continuing to run.
    // exit; is required to actually halt execution after the redirect.
    exit;
}

$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];

// Get just the first name for the greeting
$name_parts = explode(' ', trim($complete_name));
$first_name = $name_parts[0];
?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
</head>
<body>
<section class="section">
    <h1 class="title">Instructions</h1>
    <h2 class="subtitle">
        Hello <?php echo htmlspecialchars($first_name); ?>, please read the instructions first
    </h2>

    <form method="POST" action="quiz.php">
        <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
        <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
        <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />

        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>

        <div class="field">
            <label class="label">Terms and conditions</label>
            <div class="control">
                <textarea class="textarea" readonly>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                <input type="checkbox" id="agree-checkbox" name="agree">
                I agree to the <a href="#">terms and conditions</a>
                </label>
            </div>
        </div>

        <button type="submit" class="button is-link" id="start-quiz-btn" disabled>Start Quiz</button>
    </form>
</section>

<script>
    const agreeCheckbox = document.getElementById('agree-checkbox');
    const startQuizBtn = document.getElementById('start-quiz-btn');

    agreeCheckbox.addEventListener('change', function() {
        startQuizBtn.disabled = !agreeCheckbox.checked;
    });
</script>

</body>
</html>