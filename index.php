<?php
include("inc/quiz.php");

// Dynamically render the current question number in the page title
$pageTitle = "Math | Question " . $questionNumber . " of " . $numberOfQuestions;

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