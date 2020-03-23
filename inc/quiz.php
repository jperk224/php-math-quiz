<?php
// Include questions from the generate_questions.php file
// This will create an associative array of random questions
include("generate_questions.php");

// Start the score at 0, but don't overwrite it if it's already set
if(!isset($_SESSION["playerScore"])) {
    $_SESSION["playerScore"] = 0;
}

// Make a variable to hold the toast message and set it to an empty string
$toastMessage = "";

// Take the questionNumber value passed in the form submission from the post (i.e. user's answer submission)
// and set it equal to the current $questionNumber to render the associated question in the array.
// Stepping through the question array by index ensures all questions are rendered and no question is duplicated
// use filter_sanitize_number int to remove all characters except digits, plus and minus sign.
// use INPUT_GET b/c we're filtering data pulled from the query string even though method is post (we've appended
// the form method url below)
$questionNumber = filter_input(INPUT_GET, "questionNumber", FILTER_SANITIZE_NUMBER_INT);

// If the questionNumber value from form submittion is empty (i.e. not part of form submission)
// $questionNumber will be empty, so set it to 1 to start the game from the beginning
if(empty($questionNumber)) {        
    $questionNumber = 1;
}

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
    echo("Post Received");  // Test that post was received
}

// display appropriate toast message based on correct answer
// if correct, increment player score
if(isset($_SESSION["userAnswer"][($questionNumber - 1)])) {
    if($_SESSION["userAnswer"][($questionNumber - 1)] == $_SESSION["correctAnswer"][($questionNumber - 1)]) {
        echo "Congratulations!!";
        $_SESSION["playerScore"]++;
    }
    else {
        echo "Bummer";
    }
}

// var_dump($_SESSION);

// If question number exceeds the set number of questions, redirect to game over page
if($questionNumber > $numberOfQuestions) {
    header("location:game-over.php");
}

/*
    If the server request was of type POST
        Check if the user's answer was equal to the correct answer.
        If it was correct:
            1. Assign a congratulutory string to the toast variable
            2. Increment the session variable that holds the total number correct by one.
        Otherwise:
            1. Assign a bummer message to the toast variable.
*/

/*
    Check if a session variable has ever been set/created to hold the indexes of questions already asked.
    If it has NOT: 
        1. Create a session variable to hold used indexes and initialize it to an empty array.
        2. Set the show score variable to false.
*/


/*
  If the number of used indexes in our session variable is equal to the total number of questions
  to be asked:
        1.  Reset the session variable for used indexes to an empty array 
        2.  Set the show score variable to true.

  Else:
    1. Set the show score variable to false 
    2. If it's the first question of the round:
        a. Set a session variable that holds the total correct to 0. 
        b. Set the toast variable to an empty string.
        c. Assign a random number to a variable to hold an index. Continue doing this
            for as long as the number generated is found in the session variable that holds used indexes.
        d. Add the random number generated to the used indexes session variable.      
        e. Set the individual question variable to be a question from the questions array and use the index
            stored in the variable in step c as the index.
        f. Create a variable to hold the number of items in the session variable that holds used indexes
        g. Create a new variable that holds an array. The array should contain the correctAnswer,
            firstIncorrectAnswer, and secondIncorrect answer from the variable in step e.
        h. Shuffle the array from step g.
*/