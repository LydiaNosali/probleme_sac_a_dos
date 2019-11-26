<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
	<style>
	   .content{
	   	
	   }
	   fieldset{
	   	width: 25%;
	   	margin: auto;
	   }
	   table{
	   	margin: auto;
	   	
	   }
	   input[type='number']{
	   	width: 50px;
	   }
	   body{
	   	font-family: Courgette;
	   	background-image: url(./fond6.jpg);
	   	background-position: center;
 		background-repeat: no-repeat;
	   }
	   .titre{
	   	text-align: center;
	   	font-family: Courgette;
	   	font-size: 55px;
	   }
	   legend{
	   	margin: auto;
	   }
	   td{
	   	text-align: center;
	   }
	   .label-container{
	   	text-align: center;
	   }
    </style>
</head>
<body>

	<h1 class="titre">Problème du sac à dos</h1>
	  <div class="content">
	     <form method="post" action="./welcome.php">
		    <fieldset><legend>Informations générales</legend>
            <br>
            <div class="label-container">
		      <label for="nombre_objets">Nombre d'objets</label>
		      <input type="number" min="1" name="nombre_objets" id="nombre_objets" required><br><br>
		      <input type="submit" value="suivant">
	        </div>    
            </fieldset>
	      </form>
          <br><br>
	<?php
      if(isset($_POST['nombre_objets'])){
      	$n=$_POST['nombre_objets'];
      	?>
      	<form method="post" action="./resultat.php">
      		<fieldset><legend>Tableau des poids et des valeurs</legend>
      			<br>
      	  <table>
      	    <tr>
              <th>Objet</th>
              <?php for($i=0;$i<$n;$i++) {$j=$i+1; echo '<td>'.$j.'</td>';} ?>
            </tr>

            <tr>
        	  <th>Poids</th>
              <?php for($i=0;$i<$n;$i++) echo '<td><input type="number" name="poids[]" required></td>'; ?>
            </tr>

            <tr>
              <th>Valeur</th>
              <?php for($i=0;$i<$n;$i++) echo '<td><input type="number" name="valeur[]" required></td>'; ?>
            </tr>
        </table><br><br>
        <div class="label-container">
          <label for="poids_sac_a_dos">Poids du sac à dos</label>
		  <input type="number" min="1" name="poids_sac_a_dos" id="poids_sac_a_dos" required><br><br>
          <input type="submit" value="confirmer">
        </div>
         </fieldset>
      </form><br><br>
     <?php } ?>
</div>
</body>
</html>