<!DOCTYPE html>
<html>
<head>
  <title>Risultati</title>
</head>
<body>
<?php
	$dataInizio=$_REQUEST['dataInizio'];
    $dataFine=$_REQUEST['dataFine'];

    $conn=new PDO('mysql:host=localhost;dbname=my_andresti', 'andresti', '');

    /* Query SQL */
	$query="SELECT DISTINCT titolo, cognome
      FROM attivita
      INNER JOIN film ON attivita.idFilm=film.id
      INNER JOIN persone ON attivita.idPersona=persone.id
      INNER JOIN ruoli ON attivita.idRuolo=ruoli.id
      INNER JOIN proiezioni ON film.id=proiezioni.idFilm
      INNER JOIN sale ON sale.id=proiezioni.idSala
      INNER JOIN citta ON citta.id=sale.idCittà
      WHERE dataProiezione > '$dataInizio'
      AND dataProiezione < '$dataFine'
      AND citta.nomeCittà LIKE 'milano'
      AND nomeRuolo LIKE '_egista'";
    
	/* Compilazione della query */
	$q=$conn->prepare($query);
    
    /* Esecuzione della query */
	$q->execute();
    
    /* Fetch di tutte le righe restituite */
 	$res = $q->fetchAll();

    /* Visualizzazione risultati */
	foreach($res as $row) {
      echo $row['titolo'] . " - " . $row['cognome'] . "<br>";
	}
?>
</body>
</html>
