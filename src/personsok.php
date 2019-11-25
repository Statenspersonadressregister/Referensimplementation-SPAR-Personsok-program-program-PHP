<html>
<head>
    <title>Exempelanvändning av SPAR Personsök program-program version 2019.1</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resurser/personsok.css">
</head>
<body>
<main>
<h1 class="sidotitel">Exempelanvändning av SPAR Personsök program-program version 2019.1</h1>

<?php
require_once 'personsok_fraga.php';
require_once 'personsok_svar.php';

if (!empty($_POST)) {
    try {
        $svar = skickaFraga();
        visaSvar($svar);
    } catch (Exception $fault) {
        echo "<h1>Fel vid fråga</h1>";
        echo "<pre>";
        print_r($fault);
        echo "</pre>";
    }
}

// Formulär för att fylla i alla värden för en sökning
include 'personsok_sokform.php';
?>
</main>
</body>
</html>
