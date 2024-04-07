<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="style.css"> -->
  <link rel="stylesheet" href="play.css">
  <title>Play</title>
</head>
<body>


  <?php

    // Read the trivia questions and answers from the file
    $triviaData = file_get_contents('questions.txt');

    // Explode the string into an array of question-answer pairs
    $questionsAndAnswers = explode(';', $triviaData);

    $triviaObjects = [];

  // Loop through each question-answer pair and create trivia objects
  foreach ($questionsAndAnswers as $pair) {
    if ($pair == "") break;
    
    // Separate the question, options, and correct option number
    list($question, $option1, $option2, $option3, $option4, $correctOptionNumber) = explode(':', $pair);
    
    // Create a trivia object and add it to the array
    $triviaObjects[] = (object) [
        'question' => $question,
        'options' => [$option1, $option2, $option3, $option4],
        'correctOptionNumber' => (int)$correctOptionNumber
    ];
  }

  $currQuestion = 0;
  $currScore = 0;

  function isOptionCorrect($questionNumber, $selectedOption, $triviaObjects) {
    // Get the correct option number for the given question
    $correctOptionNumber = $triviaObjects[$questionNumber]->correctOptionNumber;

    return $correctOptionNumber == $selectedOption;

  }

  
  if(array_key_exists( "selectedOption", $_GET)){
    $questionNumber = $_GET["currQuestion"]; // Change this to the current question number
    $selectedOption = $_GET["selectedOption"]; // Change this to the selected option
    // Check if the selected option is correct for the given question number
    $currScore = ($questionNumber) * 10;

    if (isOptionCorrect($questionNumber, $selectedOption, $triviaObjects)) {
      $currQuestion = $questionNumber + 1;

      if($currQuestion == 9){
        header("Location: score.php?status=won&score=100");
      }

    } else {
      header("Location: score.php?status=lost&score={$currScore}");


    }
  }

  




  
  function populateOptions($questionNumber, $triviaObjects){
    $questionObj = $triviaObjects[$questionNumber];

    $answers = $questionObj->options;
    $correctOptionNumber = $questionObj->correctOptionNumber;

    foreach ($answers as $index => $option) {
        // Determine if this option is the correct one
        $isCorrect = ($index + 1) == $correctOptionNumber;

        $optionNo = $index+1;

        // Output the option as a submit button
        echo "<button type='submit' class='option' name='selectedOption' value='$optionNo'>$option</button>";
        
        // If this is the correct option, also include a hidden input to store the correct option number
        if ($isCorrect) {
            // echo "<input type='hidden' name='correctOptionNumber' value='$correctOptionNumber'>";
        }
    }

    echo "<input type='hidden' name='currQuestion' value='$questionNumber'>";

  }

  $nextQuestionLink = "play.php?currQuestion={$currQuestion}&currScore={$currScore}"
  ?>


  <nav>
    <div>
      Future Millionaire
    </div>
  </nav>

  <main>

    <div>
      <h1>
        Question: <?= $currQuestion + 1 ?>
      </h1>
      <div>
        Current Score: <?= $currScore?>
      </div>
    </div>

    <form action="<?php echo $nextQuestionLink; ?>" method="GET" class="question_answers">
      <p>
        <?= $triviaObjects[$currQuestion]->question?>
      </p>

      <div class="options">
        <?php populateOptions($currQuestion, $triviaObjects)?>
      </div>
    </form>

  </main>



  

</body>
</html>
