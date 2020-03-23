<?php
// Start the session - this is needed before anything else to get session variables
session_start();

// Dynamically render the final score in the page title
$pageTitle = "Game Over. Final Score: " . $_SESSION["playerScore"];

include('inc/header.php');

?>

<?php
include('inc/footer.php');
?>
        <!-- The quiz-box id is the same as on index.php.  While not ideal nor best practice,
        I am duplicating the id across files.  When I changed the id to a class, the styling
        was lost on both pages.  Troubleshooting the CSS to solve this is beyond the scope of this
        project.  I've also used inline styling below, as CSS standards and best practices are
        also betond the scope of this project -->
        <div id="quiz-box" style="line-height: 1.5;">
            <p class="breadcrumbs"><?php echo "Game Over - Your final score is " . $_SESSION["playerScore"]; ?></p>
            <form method="post" action="index.php">
            <!-- Display user answers vs. actual answers -->
            <table>
                <tr>
                    <th style="padding-right: 20px;">Question</th>
                    <th style="padding-right: 20px;">Your Answer</th>
                    <th style="padding-right: 20px;">Correct Answer</th>
                </tr>
                <?php for($i = 1; $i <= count($_SESSION["userAnswer"]); $i++) {
                    echo "<tr>";
                    echo "<td style=\"padding-right: 20px;\">" . $i . "</td>";
                    echo "<td style=\"padding-right: 20px;\">" . $_SESSION["userAnswer"][$i] . "</td>";
                    echo "<td style=\"padding-right: 20px;\">" . $_SESSION["correctAnswer"][$i] . "</td>";
                    if($_SESSION["userAnswer"][$i] == $_SESSION["correctAnswer"][$i]) {
                        echo "<td>Correct</td>";
                    }
                    else {
                        echo "<td>Incorrect</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
            <input type="submit" class="btn" value="Play Again?">
            </form>
        </div> <!-- end quiz-box div -->