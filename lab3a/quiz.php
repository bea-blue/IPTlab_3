<?php

require "helpers.php";

// from the $_SERVER global variable, check if the HTTP method used is POST, if its not POST, redirect to the index.php page
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    // BUG FIX: exit; was missing, same issue as instructions.php
    exit;
}

$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];
$agree = $_POST['agree'];

// TASK: instead of tracking position with a string length trick and
// showing one question at a time, we now load every question at once.
$questions = retrieve_questions();
$all_questions = $questions['questions'];
$total_questions = count($all_questions);
?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
</head>
<body>
<section class="section">
    <h1 class="title">Quiz</h1>
    <h2 class="subtitle" id="timer-display">Time remaining: 60 seconds</h2>

    <!-- Since all questions load at once, this form is submitted only once,
         straight to results.php -->
    <form method="POST" action="result.php" id="quiz-form">
        <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
        <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
        <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />
        <input type="hidden" name="agree" value="<?php echo htmlspecialchars($agree); ?>" />

        <?php foreach ($all_questions as $index => $question): ?>
            <?php $question_number = $index + 1; ?>
            <div class="box">
                <p class="has-text-weight-bold">
                    Question <?php echo $question_number; ?> / <?php echo $total_questions; ?>
                </p>
                <p><?php echo htmlspecialchars($question['question']); ?></p>

                <?php foreach ($question['options'] as $option): ?>
                <div class="field">
                    <div class="control">
                        <label class="radio">
                            <input type="radio"
                                name="answers[<?php echo $question_number; ?>]"
                                value="<?php echo htmlspecialchars($option['key']); ?>" />
                                <?php echo htmlspecialchars($option['value']); ?>
                        </label>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="button is-link">Submit</button>
    </form>
</section>

<script>
    // TASK: auto-submit the form 60 seconds after page load
    let secondsLeft = 60;
    const timerDisplay = document.getElementById('timer-display');
    const quizForm = document.getElementById('quiz-form');

    const countdown = setInterval(function() {
        secondsLeft--;
        timerDisplay.textContent = 'Time remaining: ' + secondsLeft + ' seconds';

        if (secondsLeft <= 0) {
            clearInterval(countdown);
            quizForm.submit();
        }
    }, 1000);
</script>

</body>
</html>