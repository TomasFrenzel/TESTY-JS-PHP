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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetchQuestions();
        });

        function fetchQuestions() {
            fetch('get_questions.php')
                .then(response => response.json())
                .then(data => {
                    displayQuestion(data[0]); // Zobrazíme první otázku po načtení
                });
        }

        function displayQuestion(question) {
            const questionElement = document.getElementById('question');
            questionElement.innerHTML = question.question_text;

            const answersElement = document.getElementById('quiz-form');
            answersElement.innerHTML = '';
            question.answers.forEach((answer, index) => {
                const input = document.createElement('input');
                input.type = 'radio';
                input.name = 'answer';
                input.value = index;
                input.id = 'answer' + (index + 1);

                const label = document.createElement('label');
                label.htmlFor = 'answer' + (index + 1);
                label.innerText = answer.answer_text;

                answersElement.appendChild(input);
                answersElement.appendChild(label);
                answersElement.appendChild(document.createElement('br'));
            });
        }

        document.getElementById('quiz-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            const answerIndex = parseInt(formData.get('answer'));
            checkAnswer(answerIndex);
        });

        function checkAnswer(answerIndex) {
            // Zde můžete provést kontrolu odpovědi
            // Například, můžete odeslat AJAX požadavek na server a zkontrolovat správnost odpovědi
            const resultElement = document.getElementById('result');
            if (answerIndex === correctAnswerIndex) {
                resultElement.innerText = 'Správně!';
            } else {
                resultElement.innerText = 'Špatně!';
            }
        }
    </script>
</body>
</html>