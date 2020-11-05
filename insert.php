<?php
//Tjekker at det kommer fra en form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//definerer PHP variable så vi kan bruge dem i koden herunder
//FILTER_SANITIZE tjekker at der ikke bliver modtaget forkerte data
$email = (filter_var($_POST["email"], FILTER_SANITIZE_STRING));
//Her definreres det svar der skal sendes til brugeren, hvis (if) denne efterlader et felt tomt
if (empty(email)){
  die("Indtast email");
}
//starter forbindelsen til databasen
$db = mysqli_connect('localhost','said0206','Beea7055#','said0206');
// tjek forbindelsen
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
//Variablen $insert defineres
//Forbereder (prepare) $db forbindelsen til at indsætte data fra den angivne forespørgsel
$insert = $db->prepare("INSERT INTO nyhedsmail (email) VALUES(?)");

//forbind parametere til datatyper, hvor (s = string, i = integer)
$insert->bind_param('s', $email); //bind værdier og eksekver indsættelse af forespørgslen
//Udfører eller eksekver $insert variablens forespørgsel (execute)
if($insert->execute()){
//Hvis (if) eksekveringen går igennem skal dette vises til brugeren (print)
  print "Hej " . $email . "!<br>Din indtastning er gemt!<br><b><a href=index.html>Tilbage til indtasning</a></b>";
//ellers vis fejlbesked
}else{
  print $db->error;
}
}
//Lukker forbindelsen igen
mysqli_close($db);
?>
