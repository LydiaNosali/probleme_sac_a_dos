<!DOCTYPE html>
<head>
   <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
  <style>
     .result{
      text-align: center;

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
      font-size: 30px;
      font-family: Courgette;
      background-image: url(./fond6.jpg);
      background-color: rgba(0, 0, 0, 0);
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
     td,th{
      text-align: center;
      width: 25%;
     }
     .label-container{
      text-align: center;
     }
     .val{
      color: #FE028A;
     }
     hr{
      width: 30%;
     }
    </style>
</head>

<body>
  <h1 class="titre">Problème du sac à dos</h1><br><br>
 
 <?php 
          if(isset($_POST['poids']) && isset($_POST['valeur']) && isset($_POST['poids_sac_a_dos'])){
          	$w=$_POST['poids_sac_a_dos'];
          	$poids=$_POST['poids'];
          	$valeurs=$_POST['valeur'];
          	$gain=P($w,$poids,$valeurs);
          	?>
             
          	<?php
          }
      ?>
     
     <?php function P($w,$poids,$valeur) {
     	  $n=sizeof($poids);
     	  $p=array();
          for($i=0;$i<$n+1;$i++) $p[$i][0]=0;
          for($j=0;$j<$w+1;$j++) $p[0][$j]=0;

          for($i=1;$i<$n+1;$i++)
          for($j=1;$j<$w+1;$j++){
          	$weight=$poids[$i-1];
            if($j<$weight) $p[$i][$j]=$p[$i-1][$j]; //cas non-pris car le poids de l'objet dépasse la contenance
            else{
            	$value=$valeur[$i-1];
            	$p[$i][$j]=max($p[$i-1][$j-$weight]+$value,$p[$i-1][$j]);
            }
          }

          //****************************************Objets pris et non pris************************************
          $statut=array();
          $pspec=array();
          
          for($cpt=0;$cpt<$n;$cpt++){
          	

            //for($i=0;$i<$n;$i++) $pspec[$i][0]=0;
            //for($j=0;$j<$w-$pods+1;$j++) $p[0][$j]=0;

          	$val=$valeur[$cpt];
            $pods=$poids[$cpt];
            if($pods<=$w){ //possibilité d'etre pris
              //nouvelle matrice p[n-1,w-wi]
              for($i=0;$i<$n;$i++) $pspec[$i][0]=0;
              for($j=0;$j<$w-$pods+1;$j++) $pspec[0][$j]=0;
              
              $iter=1;
              for($i=0;$i<$n;$i++){ //parcourir tous les objets (verrouillés ou pas)
                 if($i!=$cpt){ //objet non verouillée
              
                   for($j=1;$j<$w-$pods+1;$j++){
                      $weightspec=$poids[$i];
                      if($j<$weightspec) $pspec[$iter][$j]=$pspec[$iter-1][$j]; //cas non-pris car le poids de l'objet dépasse la contenance
                      else{
                        $valuespec=$valeur[$i];
                        //echo 'hallo     ';
                        //echo $pspec[$iter-1][$j-$weightspec];
                        $pspec[$iter][$j]=max($pspec[$iter-1][$j-$weightspec]+$valuespec,$pspec[$iter-1][$j]);
                          }
                    }
                    $iter++;
                 }
             }
             if($pspec[$n-1][$w-$pods]+$val==$p[$n][$w]) $statut[$cpt]=1;
             else $statut[$cpt]=0;
            }
            else $statut[$cpt]=0;
          }
          ?>
          
           <table>
              	<tr>
              		<th>Objet</th>
              		<th>Poids</th>
              		<th>Valeur</th>
              	</tr>
              	<?php
                   
                   for($i=0;$i<$n;$i++){
                   	if($statut[$i]==1){
                      $j=$i+1;
                   		echo '<tr>';
                   		echo '<td>'.$j.'</td>';
                   		echo '<td>'.$poids[$i].'</td>';
                   		echo '<td>'.$valeur[$i].'</td>';
                   		echo '</tr>';
                   	}
                   }
              	?>
              </table>
              <hr>
              <p class="result">le gain optimal est: <?php echo '<span class="val">'.$p[$n][$w].'</span>'; ?></p>
              <?php
   
          return 0;
     }
     ?>

   </body>