<?php
// Start the session - this is needed before anything else to get session variables
session_start();

// Generate random questions
// Declare the number of questions
$numberOfQuestions = 10;
// Declare operands for random number generator
$maxOperand = 100;
$minOperand = 1;
// Flag to drive loops to ensure randomly generated questions and answers are unique
$isUnique;

// Declare the empty array to add random questions to
$questionArray = array();

// Loop for required number of questions
// A for loop is used as the number of iteraitons (i.e. $numberOfQuestions) is known
for($i = 0; $i < $numberOfQuestions; $i++) {
    // use a do-while loop so a question is generated at least once before checking for uniqueness
    do {
        $isUnique = true;   // assume a unique question will be generated
        // Create randon numbers to add
        $num1 = rand($minOperand, $maxOperand);
        $num2 = rand($minOperand, $maxOperand);
        // test for uniqueness, if it's not unique try again (i.e. $isUnique = false)
        // loop through the existing quesitons array, if num1 and num2 in the same element exist, there's
        // already an element with these operands and this iteration is not unique.  
        // Set the flag to false to loop again
        foreach($questionArray as $question) {
            if(($num1 == $question["num1"]) && ($num2 == $question["num2"])) {
                $isUnique = false;
                break;      // You've found an existing entry, break out of the loop
            }
        }
    } while(!$isUnique);
    
    $correctAnswer = $num1 + $num2;     // correct answer
    
    // Detemrine two wrong answers, use another loop to ensure uniqueness
    // that (1) neither wrong answer is the same as the correct answer and (2) they aren't identical
    do {
        $isUnique = true;   // assume unique wrong answers will be generated
        // create two wrong answers within ten numbers either way of the correct answer
        $firstWrongAnswer = rand(($correctAnswer - 10), ($correctAnswer + 10));
        $secondWrongAnswer = rand(($correctAnswer - 10), ($correctAnswer + 10)); 
        if  (($firstWrongAnswer == $correctAnswer) 
            || ($secondWrongAnswer == $correctAnswer) 
            || ($firstWrongAnswer == $secondWrongAnswer)) {
            $isUnique = false;
        }
    } while(!$isUnique);
  
    // Add question and answer to questions array        

    $questionArray[] = array(
        "num1" => $num1,
        "num2" => $num2,
        "correctAnswer" => $correctAnswer,
        "firstWrongAnswer" => $firstWrongAnswer,
        "secondWrongAnswer" => $secondWrongAnswer,
    );
} 

// Create a session array of quesitons
// While it's storing an extra Session variable server side, without it
// a new array will be generated with each page load and exposes the chance,
// albeit with extremely low probability, the same quesiton is generated twice
if(!isset($_SESSION["questionArray"])) {
    $_SESSION["questionArray"] = array();
    foreach($questionArray as $question) {
        $_SESSION["questionArray"][] = $question;
    }
}
