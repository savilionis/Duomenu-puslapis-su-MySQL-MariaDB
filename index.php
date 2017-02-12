<?php include "php/config.php";?>
<?php

//Rikiavimas pagal kiekvieną iš stulpelių
if (isset($_GET['sort']) && $_GET['sort']=="asc") {
	$order = "ORDER BY ".$_GET['by']." desc";
	$r = "&#8679;";
	$sort ="desc";
}elseif( isset($_GET['sort']) && $_GET['sort']=="desc" ) {
	$order = "ORDER BY ".$_GET['by']." asc";
	$sort = "asc";
	$r = "&#8681;";
} else {
	$sort = "desc";
}

//search skiltyje įrašo reikšmę, kuri buvo "atsiųsta" iš knygos vid psl.
if (isset($_GET['rez'])){
	$rez = $_GET['rez'];

}

//puslapiavimas:
$t = mysqli_query($conn, "SELECT * FROM Knygos $order");
$total = mysqli_num_rows($t);
$start = 0;
$limit = 10; //Kiek rodoma puslapyje knygų


 if (isset($_GET['pgNr']))
 {
 	$pgNr = $_GET['pgNr'];
 	$start = ($pgNr-1)*$limit; //rodoma nuo paskutinio buvusio prieš tai
 }
 else
 {
 	$pgNr = 1;
}

$rodoma = ceil($total/$limit);
$query = mysqli_query($conn, "SELECT * FROM Knygos $order limit $start, $limit");

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="NFQ #1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.7.0/css/flag-icon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <title>Mano knyga!</title>

  </head>

  <body class="container-fluid">

	  	<div class="jumbotron">
	  		<div class="tekstas">
			  	<h1>Mano mėgstamiausia knyga!</h1>
			  	<p>Sužinok daugiau apie savo mėgstamiausią knygą</p>
			</div>
		</div>

  	 <div class="container">
		<div class="row"><div class="col-md-2"> </div>
	  	 	<div class="col-md-8">

							<div class="form-group pull-right">
								<input type="text" class="search form-control" placeholder="Paieška" value="<?echo $rez?>">
							</div>

	         			<table class="table table-hover table-responsive results">

	  				<tr>
	  					<th class="col-fixed-450"><a href="?sort=<?=$sort?>&by=pavadinimas">
	  						<!-- Rikiuojama pagal pasirinktą stulpelį. Pabraukiama ir pridedama rodiklytė prie stulpelio pavadinimo -->
	  						<?php if($_GET['by']=="pavadinimas")echo "<u>"?>Pavadinimas<?php if($_GET['by']=="pavadinimas")echo "</u>&nbsp;".$r;?></a></th>

	  					<th class="col-fixed-150"><a href="?sort=<?=$sort?>&by=metai">
	  						<?php if($_GET['by']=="metai")echo "<u>"?>Išleista<?php if($_GET['by']=="metai")echo "</u>&nbsp;".$r;?></a></th>

	  					<th class="col-fixed-330"><a href="?sort=<?=$sort?>&by=autorius">
	  						<?php if($_GET['by']=="autorius")echo "<u>"?>Autorius (-iai)<?php if($_GET['by']=="autorius")echo "</u>&nbsp;".$r;?></a></th>

	  					<th class="col-fixed-200"><a href="?sort=<?=$sort?>&by=zanras">
	  						<?php if($_GET['by']=="zanras")echo "<u>"?>Žanras<?php if($_GET['by']=="zanras")echo "</u>&nbsp;".$r;?></a></th>
	  				</tr>
				  <?php
					if (mysqli_num_rows($query) > 0) {
					    // Kiekvienos iš eilučių išedimas
					    while($row = mysqli_fetch_assoc($query)) {?>

					    	<tr>
					    		<td><a onclick="location.href='knyga/knyga.php?id=<?=$row['Id'];?>'" onmouseover="" style="cursor: pointer;"><?=$row['pavadinimas'];?></a></td>
					    		<td><?=$row['metai']?></td>
					    		<td><?=$row['autorius']?></td>
					    		<td><?=$row['zanras']?></td>
					       	</tr>

					    <?}
					} else {
					    echo "Nėra įrašų";
					}

					mysqli_close($conn);

				  ?>
				</table>
				<ul class="pagination pull-right">
					<?php // tikrinama ar pislapis nera pirmas. Jeigu yra pirmas rodyklytes nerodomos
						if($pgNr > 1) {
					?>
					 <li> <a href="?pgNr=<?echo ($pgNr-1);?>">&laquo;</a></li>
					 <?php }?>
					  <?php

					 for($i=1; $i <= $rodoma; $i++)
					 {?>
					 	<li class ="<?php if($_GET['pgNr']==$i){
					 	echo 'active';
					 	}
					 	?>"> <a href="?pgNr=<?echo $i;?>"><?echo $i;?></a></li>
					 	<?php
					 }?>

					 <?php  // tikrinama ar pislapis nera paskutinis (t.y. sutampa puslapio nr su kiek psl dotyri). Jeigu yra paskutinis rodyklytes nerodomos
					 if ($pgNr != $rodoma){
					 ?>
					 <li> <a href="?pgNr=<?echo ($pgNr+1);?>">&raquo;</a></li>
					 <?php } ?>
					</ul>

			</div>
		 </div>
  <div class="footer">
		<footer>
          <p>Stasys Savilionis &copy;&nbsp;+37061630336 stasys.savilionis@gmail.com </p>
        </footer>
  </div>

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/search.js"></script>
  	</div>
  </body>
</html>
