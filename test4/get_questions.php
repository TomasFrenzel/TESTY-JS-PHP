<?php
// Připojení k databázi
$conn = mysqli_connect("localhost", "root", "303tina2005T", "quiz");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Získání otázky a odpovědí z databáze
$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);

$questions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $question = [
        'id' => $row['id'],
        'question_text' => $row['question_text'],
        'answers' => []
    ];

    $sql_answers = "SELECT * FROM answers WHERE question_id=" . $row['id'];
    $result_answers = mysqli_query($conn, $sql_answers);

    while ($answer_row = mysqli_fetch_assoc($result_answers)) {
        $question['answers'][] = [
            'id' => $answer_row['id'],
            'answer_text' => $answer_row['answer_text'],
            'is_correct' => $answer_row['is_correct']
        ];
    }

    $questions[] = $question;
}

echo json_encode($questions);

mysqli_close($conn);
?>