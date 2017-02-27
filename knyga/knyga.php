<?php include "../php/config.php";?>
<?
$edit = $_GET['id'];
if (isset($edit) && is_numeric($edit)){
	$sql = "SELECT * FROM Knygos WHERE id = '$edit' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	if ($row = mysqli_fetch_assoc($result)) {
		$pavadinimas = $row['pavadinimas'];
		$metai = $row['metai'];
		$autorius = $row['autorius'];
		$zanras = $row['zanras'];
		$Id = $row['Id'];
	}

}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="savilionis.lt">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.7.0/css/flag-icon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">

    <title>Mano knyga!</title>

  </head>

  <body class="container-fluid">

	  	<div class="jumbotron">
	  		<div class="tekstas">
			  	<h1>Mano mėgstamiausia knyga!</h1>
			  	<p>Sužinok daugiau apie savo mėgstamiausią knygą.</p>
			</div>
		</div>

  	 <div class="container">
		<div class="row"><div class="col-md-3"> </div>
  	 	<div class="col-md-6">
  	 		<br>
  	 		<p><a href="../index.php">< Atgal į sąrašą</a><p>

  	 		<div class="row">
        		<div class="col-md-6">
           			<span class="placeholder"></span>
        		</div>
        		<div><a href="../index.php?rez=<?=$row['zanras'];?>"> <?=$row['zanras'];?></a></div>
	        	<div><h1><?=$row['pavadinimas'];?></h1></div>
	        	<div><span><?=$row['autorius'];?></span></div>
	        	<div><span><?=$row['metai'];?></span></div>
	        	<br>
	        	<p>There are many variations of passages of Lorem Ipsum available,
	        	but the majority have suffered alteration in some form, by injected humour,
	        	or randomised words which don't look even slightly believable. If you are going
	        	to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing
	        	hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat
	        	predefined chunks as necessary, making this the first true generator on the Internet.
	        	It uses a dictionary of over 200 Latin words, combined with a handful of model sentence
	        	structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum
	        	is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
    		</div><br>
		</div>
  </div>
  <div class="footer">


        <footer>
          <p>Stasys Savilionis &copy;&nbsp;+37061630336 stasys.savilionis@gmail.com </p>
    	</footer></div>
   </div>

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
