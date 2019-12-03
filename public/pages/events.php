
<!DOCTYPE html>
<html>
<head>
<style>

.Event {
  float: left;
  width: 100%;
  padding: 8px;
}

</style>
</head>
<body>

<h1 align="center">Chess Society Events</h1>

<h2>Opening Events</h2>

<p>Click title for more details</p>

  <a href="<?php echo 'show.php?event='.$db['event']?>"><div class="Event" style="background-color:#aaa;">
    <h2>Event</h2>
    <p>..</p>
  </div></a>
  
    <a href="<?php echo 'show.php?event='.$db['event']?>"><div class="Event" style="background-color:#bbb;">
    <h2>Event</h2>
    <p>..</p>
  </div>
</div></a>

    <a href="<?php echo 'show.php?event='.$db['event']?>"><div class="Event" style="background-color:#ccc;">
    <h2>Event</h2>
    <p>..</p>
  </div></a>
  
    <a href="<?php echo 'show.php?event='.$db['event']?>"><div class="Event" style="background-color:#ddd;">
    <h2>Event</h2>
    <p>..</p>
    <p> 
  </div></a>
</div>

<h2>Tournaments</h2>

<p>Click title for more details</p>

  <a class="action" href="<?php echo 'show.php?id='.$team['id']?>"><div class="Event" style="background-color:#aaa;">
    <h2>Tournament</h2>
    <p>..</p>
  </div></a>
  
  <a class="action" href="<?php echo 'show.php?id='.$team['id']?>"><div class="Event" style="background-color:#bbb;">
    <h2>Tournament</h2>
    <p>..</p>
  </div></a>
</div>

<div class="row">
  <a class="action" href="<?php echo 'show.php?id='.$team['id']?>"><div class="Event" style="background-color:#ccc;">
    <h2>Tournament</h2>
    <p>..</p>
  </div></a>
  
  <a class="action" href="<?php echo 'show.php?id='.$team['id']?>"><div class="Event" style="background-color:#ddd;">
    <h2>Tournament</h2>
    <p>..</p></a>
  </div>
</div>
</body>
</html>
