<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css">
    <title>Exo complet lecture SQL.</title>
</head>
<body>

<?php

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'exo197';

try {
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM clients");

    $state = $stmt->execute();
    if ($state) {
        $min = $stmt->fetchAll();
        echo "<pre>";
        print_r($min);
        echo "</pre>";
        echo "<br>";
    }

    $stmt2 = $conn->prepare("SELECT * FROM showtypes");

    $state2 = $stmt2->execute();
    if ($state2) {
        $showstype = $stmt2->fetchAll();
        echo "<pre>";
        print_r($showstype);
        echo "</pre>";
        echo "<br>";
    }

    $stmt3 = $conn->prepare("SELECT * FROM clients WHERE id < 22");

    $state3 = $stmt3->execute();
    if ($state3) {
        $twenty = $stmt3->fetchAll();
        echo "<pre>";
        print_r($twenty);
        echo "</pre>";
        echo "<br>";
    }

    $stmt4 = $conn->prepare("SELECT * FROM clients WHERE card != '' AND lastName AND firstName");
    $state4 =  $stmt4->execute();

    if ($state4) {
        $clients = $stmt4->fetchAll();
        foreach ( $clients as $card) {
            echo $card['lastName'] . $card['firstname'];
        }
    }

    $stmt5 = $conn->prepare("SELECT * FROM clients WHERE lastName LIKE 'M%'");
    $state5 = $stmt5->execute();

    if ($state5) {
        $firstM = $stmt5->fetchAll();
        echo "<pre>";
        print_r($firstM);
        echo "</pre>";
        echo "<br>";
    }

    $stmt6 = $conn->prepare("SELECT * FROM shows WHERE performer AND date AND startTime");
    $state6 = $stmt6->execute();

    if ($state6) {
        $shows = $stmt6->fetchAll();
        foreach ($shows as $show){
            echo "<pre>";
            echo $shows['shows'] . "par" . $shows['performer'], "le" . $shows['date'] . "à" . $shows['startTime'];
            echo "</pre>";
            echo "<br>";
        }


        $stmt7 = $conn->prepare("SELECT * FROM clients");

        $state7 = $stmt7->execute();
       if ($state7) {
        $clicli = $stmt7->fetchAll();
        foreach ($clicli as $cli){
            echo "<pre>";
            echo "Nom: " . $cli['lastName'] . "<br>";
            echo "Prénom: "  . $cli['firstName'] . "<br>";
            echo "Date de naissance: " . $cli['birthDate'] . "<br>";
            echo "Carte de fidélité : " . $cli['card'] . "<br>";
            echo "Numéro de carte : " . $cli['cardNumber'] . "<br>";
            echo "</pre>";
            echo "<br>";
            }
        }
    }
}
    catch (PDOException $e) {
    echo $e->getMessage();
}
?>
</body>
</html>

