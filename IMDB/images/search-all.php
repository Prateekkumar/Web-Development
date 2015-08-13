<?php include ("top.html");?>
<!DOCTYPE html>
<!--
* Name: Prateek Kumar
* Description: MyMDb (Homework 4)
-->
 <?php
    
    // PHP Initialization
    ini_set         ('display_errors', 1);
    error_reporting (E_ALL | E_STRICT);
    
    // Open the DB
    $dbunix_socket = '/ubc/icics/mss/cics516/db/cur/mysql/mysql.sock';
    $dbuser        = 'cics516';
    $dbpass        = 'cics516password';
    $dbname        = 'cics516';
    
    try {
      $db = new PDO ("mysql:unix_socket=$dbunix_socket;dbname=$dbname", $dbuser, $dbpass);
      $db->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      header ("HTTP/1.1 500 Server Error");
      die    ("HTTP/1.1 500 Server Error: Database Unavailable ({$e->getMessage()})");
    }
    $firstname=$_GET["firstname"];
    $lastname=$_GET["lastname"];
    //execution of the query
    
	$rows=$db->query("SELECT m.name,m.year FROM actors a,movies m,roles r WHERE a.id=r.actor_id AND m.id=r.movie_id AND first_name='$firstname' AND last_name='$lastname' ORDER BY m.year;");
?>
<<table>
<caption><p>Films For <?php print "$firstname $lastname" ?> </p></caption>
<?php $count=1 ?>
  <tr>
    <th>#</th>
    <th>Title</th>
    <th>Year</th>
  </tr>
  <tr>
    <?php foreach ($rows as $row){
    	 ?>
  	<td><?php print ["$count"] ?></td>
    <td><?Php print $row["name"]?></td>
    <td><?Php print $row["year"]?></td>
  </tr>
</table>

<?php count=count+1; 
    }
include ("bottom.html");
?>
  
</body>
</html>