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
        $total_questions = 0;

        // Dotaz na všechny otázky
        $query = "SELECT * FROM quiz_questions";
        $result = mysqli_query($db_connection, $query);

        // Kontrola dotazu
        if ($result === false) {
            die("Chyba při provádění dotazu: " . mysqli_error($db_connection));
        }

        // Získání odpovědí a porovnání s databází
        while ($row = mysqli_fetch_assoc($result)) {
            $question_number = $row['id'];
            $correct_answer = $row['correct_answer'];

            // Kontrola, zda byla poskytnuta odpověď na tuto otázku
            if (isset($_POST['answer'][$question_number])) {
                $total_questions++;
                $user_answer = $_POST['answer'][$question_number];

                // Porovnání odpovědí s databází
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