document.addEventListener('DOMContentLoaded', function () {
    fetchQuestions();
});

function fetchQuestions() {
    fetch('get_questions.php')
        .then(response => response.json())
        .then(data => {
            displayQuestion(data);
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