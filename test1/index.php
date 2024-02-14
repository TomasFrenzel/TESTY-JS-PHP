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
            
            // Dotaz na náhodných 20 otázek
            $query = "SELECT * FROM quiz_questions ORDER BY RAND() LIMIT 20";
            $result = mysqli_query($db_connection, $query);
            
            // Kontrola dotazu
            if ($result === false) {
                die("Chyba při provádění dotazu: " . mysqli_error($db_connection));
            }
            
            // Zobrazení otázek
            $question_number = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<p>{$row['question']}</p>";
                echo "<input type='radio' name='answer[$question_number]' value='A'> {$row['option_A']}<br>";
                echo "<input type='radio' name='answer[$question_number]' value='B'> {$row['option_B']}<br>";
                echo "<input type='radio' name='answer[$question_number]' value='C'> {$row['option_C']}<br>";
                $question_number++;
            }
            
            // Uzavření spojení s databází
            mysqli_close($db_connection);
        ?>
        <br>
        <input type="submit" value="Odeslat odpovědi">
    </form>
</body>
</html>