<?php
/*
 * Program:  Gonzalez_wk2pa - index.php
 * Author:   Patrick Gonzalez
 * Course:   SDC310 Server-Side Scripting with PHP
 * Purpose:  Week 2 Performance Assessment. A single-page PHP web application
 *           that collects a user's name, date of birth, favorite color,
 *           favorite place to visit, and nickname from a form. When the form
 *           is submitted, each field that has a value is displayed with a
 *           label, and each empty field displays a message saying that the
 *           value was not entered.
 * Input:    Five text fields sent to this same page with the POST method.
 * Output:   One line per field displayed below the Submit button.
 */

// Variables that hold the values entered by the user.
// They start empty so the page has nothing to display on the first load.
$name           = '';
$date_of_birth  = '';
$favorite_color = '';
$favorite_place = '';
$nickname       = '';

// $submitted is true only after the user clicks the Submit button.
// On the first load of the page there is no POST data, so it is false.
$submitted = isset($_POST['submit']);

// Read each value from the POST superglobal when the form was submitted.
// trim() removes extra spaces so a field that only has spaces counts as empty.
if ($submitted) {
    $name           = trim($_POST['name'] ?? '');
    $date_of_birth  = trim($_POST['date_of_birth'] ?? '');
    $favorite_color = trim($_POST['favorite_color'] ?? '');
    $favorite_place = trim($_POST['favorite_place'] ?? '');
    $nickname       = trim($_POST['nickname'] ?? '');
}

/*
 * Function: show_value
 * Purpose:  Builds one line of output for a form field.
 * Params:   $value         - the value the user entered (may be empty)
 *           $label         - text shown before the value, e.g. "Your name is"
 *           $empty_message - text shown when no value was entered
 * Returns:  An HTML paragraph. The value is passed through htmlspecialchars()
 *           so any HTML the user types is displayed as text, not run.
 */
function show_value($value, $label, $empty_message)
{
    if (strlen($value) > 0) {
        return '<p class="entered">' . $label . ' <strong>'
            . htmlspecialchars($value) . '</strong></p>';
    }
    return '<p class="missing">' . $empty_message . '</p>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patrick Gonzalez Wk 2 Performance Assessment</title>
    <style>
        body     { font-family: Arial, Helvetica, sans-serif; margin: 30px; }
        label    { display: inline-block; width: 210px; font-weight: bold; }
        .field   { margin-bottom: 12px; }
        input[type="text"] { width: 250px; padding: 4px; }
        .entered { color: #1b5e20; }
        .missing { color: #b71c1c; }
    </style>
</head>

<body>
    <h1>Patrick Gonzalez Wk 2 Performance Assessment</h1>

    <!-- Form posts back to this same page so PHP can process the values. -->
    <form method="POST">
        <div class="field">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"
                value="<?php echo htmlspecialchars($name); ?>">
        </div>
        <div class="field">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="text" id="date_of_birth" name="date_of_birth" placeholder="MM/DD/YYYY"
                value="<?php echo htmlspecialchars($date_of_birth); ?>">
        </div>
        <div class="field">
            <label for="favorite_color">Favorite Color:</label>
            <input type="text" id="favorite_color" name="favorite_color"
                value="<?php echo htmlspecialchars($favorite_color); ?>">
        </div>
        <div class="field">
            <label for="favorite_place">Favorite Place To Visit:</label>
            <input type="text" id="favorite_place" name="favorite_place"
                value="<?php echo htmlspecialchars($favorite_place); ?>">
        </div>
        <div class="field">
            <label for="nickname">Nickname:</label>
            <input type="text" id="nickname" name="nickname"
                value="<?php echo htmlspecialchars($nickname); ?>">
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    // Output section: only runs after the form is submitted.
    // Each field shows its value with a label, or a "didn't enter" message.
    if ($submitted) {
        echo show_value($name, 'Your name is', "You didn't enter your name.");
        echo show_value($date_of_birth, 'Your date of birth is', "You didn't enter your date of birth.");
        echo show_value($favorite_color, 'Your favorite color is', "You didn't enter your favorite color.");
        echo show_value($favorite_place, 'Your favorite place to visit is', "You didn't enter your favorite place to visit.");
        echo show_value($nickname, 'Your nickname is', "You didn't enter your nickname.");
    }
    ?>
</body>

</html>
