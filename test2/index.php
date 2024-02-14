<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
</head>
<body>
    <h1>Quiz</h1>
    <form action="quiz_result.php" method="post">
        <?php
            // Připojení k databázi
            $db_connection = mysqli_connect("localhost", "root", "303tina2005T", "quiz");

            // Kontrola připojení
            if ($db_connection === false) {
                die("Chyba připojení k databázi: " . mysqli_connect_error());
            }

            // Dotaz na otázky
            $query = "SELECT * FROM quiz_questions";
            $result = mysqli_query($db_connection, $query);

            // Kontrola dotazu
            if ($result === false) {
                die("Chyba při provádění dotazu: " . mysqli_error($db_connection));
            }

            // Zobrazení otázek
            while ($row = mysqli_fetch_assoc($result)) {
                $question_number = $row['id'];
                echo "<h2>Otázka $question_number</h2>";
                echo "<p>{$row['question']}</p>";
                echo "<input type='radio' name='answer[$question_number]' value='A'> {$row['option_A']}<br>";
                echo "<input type='radio' name='answer[$question_number]' value='B'> {$row['option_B']}<br>";
                echo "<input type='radio' name='answer[$question_number]' value='C'> {$row['option_C']}<br>";
                echo "<input type='hidden' name='total_questions' value='$question_number'>";
                echo "<input type='submit' name='next' value='Další otázka'>";
            }

            // Uzavření spojení s databází
            mysqli_close($db_connection);
        ?>
    </form>
</body>
</html>