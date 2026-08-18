<?php
require "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    // BUG FIX: exit; was missing, same issue as the other pages.
    exit;
}

$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];
$agree = $_POST['agree'];

// The quiz page submits answers as an array: answers[1], answers[2], etc.
$answers = $_POST['answers'] ?? [];

// TASK: compute the real score instead of leaving it undefined
$score = compute_score($answers);
$max_possible_score = MAX_QUESTION_NUMBER * 100;

// TASK: hero uses is-success if score is beyond 2 points worth of
// questions (i.e. more than 200, since each question is worth 100),
// otherwise is-danger
$hero_class = $score > 200 ? 'is-success' : 'is-danger';

// TASK: confetti should only show on a perfect score
$is_perfect_score = ($score === $max_possible_score);

// TASK: reformat birthdate from YYYY-MM-DD to "Month dd, YYYY"
$formatted_birthdate = date('F d, Y', strtotime($birthdate));

// For the review table: need the questions, options, and correct answers
$questions_data = retrieve_questions();
$all_questions = $questions_data['questions'];
$correct_answers = $questions_data['answers'];

// Helper to turn an option key like "D" into its display text like "June 12"
function get_option_text($options, $key) {
    foreach ($options as $option) {
        if ($option['key'] === $key) {
            return $option['value'];
        }
    }
    return '(no answer)';
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/site/site.min.css">
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
</head>
<body>
<section class="hero <?php echo $hero_class; ?>">
    <div class="hero-body">
        <p class="title">Your Score: <?php echo $score; ?> / <?php echo $max_possible_score; ?></p>
        <p class="subtitle">This is the IPT10 PHP Quiz Web Application Laboratory Activity.</p>
    </div>
</section>
<section class="section">
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <tbody>
                <tr>
                    <th>Input Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Complete Name</td>
                    <td><?php echo htmlspecialchars($complete_name); ?></td>
                </tr>
                <tr class="is-selected">
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>
                <tr>
                    <td>Birthdate</td>
                    <td><?php echo htmlspecialchars($formatted_birthdate); ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo htmlspecialchars($contact_number); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- TASK: review table showing each question, the correct answer,
         and the user's answer -->
    <h2 class="title is-4">Answer Review</h2>
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Correct Answer</th>
                    <th>Your Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_questions as $index => $question): ?>
                    <?php
                        $question_number = $index + 1;
                        $correct_key = $correct_answers[$index];
                        $correct_text = get_option_text($question['options'], $correct_key);
                        $user_key = $answers[$question_number] ?? null;
                        $user_text = $user_key ? get_option_text($question['options'], $user_key) : '(no answer)';
                        $row_class = ($user_key === $correct_key) ? 'has-background-success-light' : 'has-background-danger-light';
                    ?>
                    <tr class="<?php echo $row_class; ?>">
                        <td><?php echo $question_number; ?></td>
                        <td><?php echo htmlspecialchars($question['question']); ?></td>
                        <td><?php echo htmlspecialchars($correct_text); ?></td>
                        <td><?php echo htmlspecialchars($user_text); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if ($is_perfect_score): ?>
    <canvas id="confetti-canvas"></canvas>
    <?php endif; ?>
</section>

<?php if ($is_perfect_score): ?>
<script>
var confettiSettings = {
    target: 'confetti-canvas'
};
var confetti = new ConfettiGenerator(confettiSettings);
confetti.render();
</script>
<?php endif; ?>

</body>
</html>