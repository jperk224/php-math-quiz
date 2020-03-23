<?php
// Include questions from the generate_questions.php file
// This will create an associative array of random questions
include("generate_questions.php");

// Make a variable to hold the toast message and set it to an empty string
$toastMessage = "";

// Take the questionNumber value passed in the form submission from the post (i.e. user's answer submission)
// and set it equal to the current $questionNumber to render the associated question in the array.
// use filter_sanitize_number int to remove all characters except digits, plus and minus sign.
// use INPUT_GET b/c we're filtering data pulled from the query string even though method is post (we've appended
// the form method url below)
$questionNumber = filter_input(INPUT_GET, "questionNumber", FILTER_SANITIZE_NUMBER_INT);

// If the questionNumber value from form submittion is empty (i.e. not part of form submission)
// $questionNumber will be empty, so set it to 1 to start the game from the beginning
// They're coming here from starting a new game, so reset their score and create a new array of questions
if(empty($questionNumber)) {        
    if(isset($_SESSION["playerScore"])) {
        $_SESSION["playerScore"] = 0;
    }
    $_SESSION["questionArray"] = array();
    foreach($questionArray as $question) {
        $_SESSION["questionArray"][] = $question;
    }
    $questionNumber = 1;
}

// Start the score at 0, but don't overwrite it if it's already set
if(!isset($_SESSION["playerScore"])) {
    $_SESSION["playerScore"] = 0;
}


// Set quesitons array to session array for the current round
$questions = $_SESSION["questionArray"];

// Array index will be one behind $questionNumber due to array zero indexing
$questionIndex = $questionNumber - 1;
// Create a session array of correct answers for comparison
// a new answer should be added with each post to hold the correct answer for 
// the current question
$_SESSION["correctAnswer"][$questionNumber] = $questions[$questionIndex]["correctAnswer"];

// check whether user answer is correct and display appropriate toast box
// Check if a user response has been posted via isset function
// input text box assigns the user response to the "answer" attribute, this will be the key
// for the post array
if(isset($_POST["answer"])) {
    // add a session variable to store the user's response to the question
    // since we post to the subsequent question, we should use answer -1 to associate
    // the answer with the appropriate question for which it was entered
    $_SESSION["userAnswer"][$questionNumber - 1] = filter_input(INPUT_POST, "answer", FILTER_SANITIZE_NUMBER_INT);
}

// display appropriate toast message based on correct answer
// if correct, increment player score
if(isset($_SESSION["userAnswer"][($questionNumber - 1)])) {
    if($_SESSION["userAnswer"][($questionNumber - 1)] == $_SESSION["correctAnswer"][($questionNumber - 1)]) {
        $toastMessage = "Yay! Well done.";
        $_SESSION["playerScore"]++;
    }
    else {
        $toastMessage = "Bummer! Too Bad.";
    }
}

// If question number exceeds the set number of questions, redirect to game over page
if($questionNumber > $numberOfQuestions) {
    header("location:game-over.php");
}
