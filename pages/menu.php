
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container-fluid" >

	<!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    <?php 
    if(!isset($_SESSION['zalogowany'])){echo '<a href="index.php"><img src="img/medkit_lg.png" height="30%" width="30%"></a>';}
    else{echo '<a href="start.php"><img src="../img/medkit_lg.png" height="30%" width="30%"></a>';};
    ?>
    </div>
    
    <div class="collapse navbar-collapse" id="myDIV">
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="../index.php" role="tab" data-toggle="tab">
      		<?php if (!isset($_SESSION['zalogowany'])){ echo $menuLog . " " . "<span class=\"glyphicon glyphicon-log-in\"></span>";}?> </a>
      	</li>
      	<?php if (isset($_SESSION['zalogowany'])) { ?>
      	
      	<li><a href="start.php" role="tab" data-toggle="tab">
      		<?php echo $menuStart . " " ."<span class=\"glyphicon glyphicon-home\"></span> ";?> </a>
      	</li>
      	
		<li><a href="mymedkit.php" role="tab" data-toggle="tab"><?php echo $menuMyMedkit . " ";?> <i class="fa fa-medkit"></i></a>
		</li>
		
		<li><a href="sharedMedKits.php" role="tab" data-toggle="tab"><?php echo $menuSharedMedkit. " ";?> <i class="fa fa-plus-square"></i></a>
		</li> 
		
		<li><a href="z_bazy.php" role="tab" data-toggle="tab"><?php  echo $menuBazy . " ";?><span class="glyphicon glyphicon-search"></a>
		</li>
		
      	<li><a href="stats.php" role="tab" data-toggle="tab"><?php  echo $menuStats . " ";?><span class="glyphicon glyphicon-stats"></span></a>
      	</li>
      	
      	<li><a href="documentation.php" role="tab" data-toggle="tab"><?php  echo $menuDok . " ";?><span class="glyphicon glyphicon-book"></span></a>
      	</li>
      	<?php } ?>
        <li><a href="../authentication/logout.php" role="tab" data-toggle="tab">
        	<?php if (isset($_SESSION['zalogowany'])){ echo $menuWyloguj. " " ."<span class=\"glyphicon glyphicon-log-out\"></span>";} ?></a>
        	</li>
        	
		<li><a href="pages/register.php" role="tab" data-toggle="tab">
			<?php  if (!isset($_SESSION['zalogowany'])){ echo $menuRegister. " " ."<span class=\"glyphicon glyphicon-user\"></span>";} ?> </a>
			</li>
			
      </ul>
    </div><!-- /.navbar-collapse -->
    
    
  </div><!-- /.container-fluid -->
</nav>




