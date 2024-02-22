<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
</head>
<body>
    <div id="quiz-container">
        <h1>Quiz</h1>
        <div id="question"></div>
        <form id="quiz-form">
            <input type="radio" name="answer" value="1" id="answer1"><label for="answer1" id="ans1"></label><br>
            <input type="radio" name="answer" value="2" id="answer2"><label for="answer2" id="ans2"></label><br>
            <input type="radio" name="answer" value="3" id="answer3"><label for="answer3" id="ans3"></label><br>
            <input type="submit" value="Submit">
        </form>
        <div id="result"></div>
    </div>

    <script src="quiz.js"></script>
</body>
</html>