<?php 
    $id = $_GET['id'];
    $event = $Event[$E_Title];
?>

<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border-collapse: collapse;
    front family: arial, sans-serif;
}
th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #dddddd
}
tr:nth-child(odd) {
    background-color: #dddddd
}
</style>
</head>
<body>

<h2>Event Details</h2>

<table style="width:100%">
  <tr>
    <th>Event Name</th>
    <th>Participant Name</th> 
    <th>Date</th>
  </tr>
  <tr>
    <td> <?php echo $event["E_Title"]; ?></td>
    <td> <?php echo $event["MemberName"]; ?></td>
    <td> <?php echo $event["E_Date"]; ?></td>
  </tr>

</table>
</body>

<br/>
<head>
    <link rel = "stylesheet"
         href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
</head>
   
   <body class = "container"> 
      <div>
         <a href="event.php" class="waves-effect waves-light btn">Back</a>
      </div>
   </body> 
</html>


