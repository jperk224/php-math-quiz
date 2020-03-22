<?php
include("inc/quiz.php");

// Take the questionNumber value passed in the form submission from the post (i.e. user's answer submission)
// and set it equal to the current $questionNumber to render the associated question in the array.
// Stepping through the question array by index ensures all questions are rendered and no question is duplicated
// use filter_sanitize_number int to remove all characters except digits, plus and minus sign.
// use INPUT_GET b/c we're filtering data pulled from the query string even though method is post (we've appended
// the form method url below)
$questionNumber = filter_input(INPUT_GET, "questionNumber", FILTER_SANITIZE_NUMBER_INT);

// If the questionNumber value from form submittion is empty (i.e. not part of form submission)
// $questionNumber will be empty, so set it to 1 to start the game from the beginning
if(empty($questionNumber)) {      // page was arrived at w/o a form post from a previous page
    // // clear session variables
    // session_destroy();  // unset all session variables at once
    $questionNumber = 1;
}

// Array index will be one behind $questionNUmber due to array zero indexing
$questionIndex = $questionNumber - 1;

// Dynamically render the current question number in the page title
$pageTitle = "Math | Question " . $questionNumber . " of " . $numberOfQuestions;

//var_dump("Question number " . $questionNumber);
//var_dump("Question index " . $questionIndex);
// var_dump($questions);

include("inc/header.php");

?>
        <div id="quiz-box">
            <p class="breadcrumbs"><?php echo "Question " . $questionNumber . " of " . $numberOfQuestions; ?></p>
            <p class="quiz"><?php echo "What is " . $questions[$questionIndex]["num1"] 
                            . " + " . $questions[$questionIndex]["num2"] . "?"; ?></p>
            <!-- with the post method, submission values are hidden from the query string,
            we can manipulate the url in the action attribute by including incremental
            quesiton numbers to render the next question in the $questions array.
            The logic above will track the quesiton number and answer submission will
            then post to the next question -->
            <?php echo '<form method="post" action="index.php?questionNumber=' . ($questionNumber + 1) . '">'; ?>
            <?php 
            // Randomize the placement of the correct answer to deter cheating :)
            $correctPlacement = rand(1,3);
            switch($correctPlacement) {
                case 1:
                    echo '<input type="submit" class="btn" name="answer" value="' 
                        . $questions[$questionIndex]["correctAnswer"] . '">';
                    echo '<input type="submit" class="btn" name="answer" value="' 
                        . $questions[$questionIndex]["firstWrongAnswer"] . '">';
                    echo '<input type="submit" class="btn" name="answer" value="' 
                        . $questions[$questionIndex]["secondWrongAnswer"] . '">';
                    break;
                case 2:
                    echo '<input type="submit" class="btn" name="answer" value="' 
                        . $questions[$questionIndex]["firstWrongAnswer"] . '">';
                    echo '<input type="submit" class="btn" name="answer" value="' 
                        . $questions[$questionIndex]["correctAnswer"] . '">';
                    echo '<input type="submit" class="btn" name="answer" value="' 
                        . $questions[$questionIndex]["secondWrongAnswer"] . '">';
                    break;
                case 3:
                default:    // This should never be reached, but if it is a default echo is set up
                    echo '<input type="submit" class="btn" name="answer" value="' 
                        . $questions[$questionIndex]["firstWrongAnswer"] . '">';
                    echo '<input type="submit" class="btn" name="answer" value="' 
                        . $questions[$questionIndex]["secondWrongAnswer"] . '">';
                    echo '<input type="submit" class="btn" name="answer" value="' 
                        . $questions[$questionIndex]["correctAnswer"] . '">';
                    break;
            }            
            ?>
            </form>
        </div> <!-- end quiz-box div -->
<?php
include("inc/footer.php");
?>