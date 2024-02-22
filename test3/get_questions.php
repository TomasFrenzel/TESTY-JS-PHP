<?php
// Připojení k databázi
$conn = mysqli_connect("localhost", "username", "password", "quiz");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Získání otázky a odpovědí z databáze
$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);

$questions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
}

foreach ($questions as $question) {
    $sql = "SELECT * FROM answers WHERE question_id=" . $question['id'];
    $result = mysqli_query($conn, $sql);
    $answers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $answers[] = $row;
    }
    $question['answers'] = $answers;
    echo json_encode($question);
}

mysqli_close($conn);
?>