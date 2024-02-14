<!DOCTYPE html>
<html>
<head>
    <title>Výsledek quizu</title>
</head>
<body>
    <h1>Výsledek quizu</h1>
    <?php
        // Připojení k databázi
        $db_connection = mysqli_connect("localhost", "root", "303tina2005T", "quiz");

        // Kontrola připojení
        if ($db_connection === false) {
            die("Chyba připojení k databázi: " . mysqli_connect_error());
        }

        $score = 0;
        $total_questions = $_POST['total_questions'];

        // Kontrola odpovědí
        for ($question_number = 1; $question_number <= $total_questions; $question_number++) {
            // Získání správné odpovědi z databáze
            $query = "SELECT correct_answer FROM quiz_questions WHERE id = $question_number";
            $result = mysqli_query($db_connection, $query);
            $row = mysqli_fetch_assoc($result);
            $correct_answer = $row['correct_answer'];

            // Porovnání odpovědí
            if (isset($_POST['answer'][$question_number])) {
                $user_answer = $_POST['answer'][$question_number];
                if ($user_answer == $correct_answer) {
                    $score++;
                }
            }
        }

        // Výpis výsledku
        echo "<p>Skóre: $score / $total_questions</p>";

        // Uzavření spojení s databází
        mysqli_close($db_connection);
    ?>
</body>
</html>