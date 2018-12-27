<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "odl";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

/* Converte la tabella degli utenti (in caso di duplicati) in una tabella identica, senza duplicati in ordine alfabetico
if ($result = $db->query("SELECT * FROM ffstory_eroi GROUP BY nome_eroe ORDER BY nome_eroe ")) {
    while($row = $result->fetch_assoc()) {
        $nome = $row['nome_eroe'];
        $result2 = $db->query("INSERT INTO ffstory_eroi_new (nome_eroe) VALUES ('$nome')");
        if(!$result2){
            echo "Error: " . $db->error . '<br>';
        }
    }
}
*/

/* Converte gli id dei capitoli della tabella eroe in una tabella associativa */
$eroi_list = $result = $db->query("SELECT * FROM ffstory_eroi");
while($row = $eroi_list->fetch_assoc()){
    $id_eroe = $row['id'];
    $nome_eroe = $row['nome_eroe'];
    $id_eroi_capitoli = $result = $db->query("SELECT id_capitolo FROM ffstory_eroi WHERE ffstory_eroi.nome_eroe = '$nome_eroe'");

    while($row_2 = $id_eroi_capitoli->fetch_assoc()){
        $id_capitolo = $row_2['id_capitolo'];
        $db->query("INSERT INTO ffstory_capitoli_eroi (id_capitolo, id_eroe) VALUES ($id_capitolo, $id_eroe)");
    }
}
/**/