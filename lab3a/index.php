<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <!-- BUG FIX: Bulma CSS was mentioned in a comment but never actually linked -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
</head>
<body>
<section class="section">
    <h1 class="title">User Registration</h1>
    <h2 class="subtitle">
        This is the IPT10 PHP Quiz Web Application Laboratory Activity. Please register
    </h2>
    <!-- BUG FIX #1: action was "pre-instructions.php" (typo, doesn't exist).
         The real file in this folder is "instructions.php". -->
    <!-- BUG FIX #2: method was GET (would put data in the URL as ?complete_name=...).
         Changed to POST so form data is sent in the request body instead. -->
    <form method="POST" action="instructions.php" id="registration-form">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input class="input" type="text" id="complete_name" name="complete_name" placeholder="Complete Name">
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" id="email" name="email" type="email" />
            </div>
        </div>

        <div class="field">
            <label class="label">Birthdate</label>
            <div class="control">
                <input class="input" name="birthdate" type="date" />
            </div>
        </div>

        <div class="field">
            <label class="label">Contact Number</label>
            <div class="control">
                <input class="input" name="contact_number" type="number" />
            </div>
        </div>

        <!-- Next button: starts disabled. JS below enables it once
             Name is filled in AND Email looks valid. -->
        <button type="submit" class="button is-link" id="next-btn" disabled>Proceed Next</button>
    </form>
</section>

<script>
    // Grab the fields and button we need to watch/control
    const nameInput  = document.getElementById('complete_name');
    const emailInput = document.getElementById('email');
    const nextBtn    = document.getElementById('next-btn');

    function validateForm() {
        const nameFilled  = nameInput.value.trim().length > 0;
        // checkValidity() uses the browser's built-in email format check
        // because the input has type="email"
        const emailValid  = emailInput.checkValidity() && emailInput.value.trim().length > 0;

        nextBtn.disabled = !(nameFilled && emailValid);
    }

    // Re-check every time the user types in either field
    nameInput.addEventListener('input', validateForm);
    emailInput.addEventListener('input', validateForm);
</script>
</body>
</html>

Hello