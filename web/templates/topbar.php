<?php
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Customer Help Center</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php print ((empty($current_content) || $current_content == "/home.php")?"active":"");?>"><a href="index.php?content=home">View Tickets </a></li>
        <li class="<?php print (($current_content == "/new_ticket.php")?"active":"");?>"><a href="index.php?content=new_ticket">Create Tickets</a></li>
        <li class="<?php print ((isset($_SESSION['user_role']) && $_SESSION['user_role']=="Tecnico")?"show ":"hidden "); print (($current_content == "/admin.php")?"active":"");?>"><a href="index.php?content=admin">Administration</a></li>
        <li class="<?php print ((isset($_SESSION['user_role']))?"show ":"hidden "); print (($current_content == "/logout.php")?"active":"");?>"><a href="index.php?content=logout">Logout</a></li>
        <li class="<?php print ((!isset($_SESSION['user_role']))?"show ":"hidden "); print (($current_content == "/login.php")?"active":"");?>"><a href="index.php?content=login">Login</a></li>
      </ul>
      <p class="navbar-text navbar-right"><?php print((isset($_SESSION['user_id']))?"Signed in as <strong>" . $_SESSION['user_email'] . "</strong>":"Not signed in");?></p>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>