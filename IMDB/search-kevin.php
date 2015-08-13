<?php include("top.html");
    
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
      header ("HTTP/1.1 500 Server testing Error");
      die    ("HTTP/1.1 500 Server Error: Database Unavailable ({$e->getMessage()})");
    }    
        $firstname = $_GET['firstname'];
	$lastname= $_GET['lastname'];
$s = $db->prepare ("SELECT m.name,m.year FROM actors a,movies m,roles r WHERE a.id=r.actor_id AND m.id=r.movie_id AND first_name='$firstname' AND last_name='$lastname'
and m.id in ( SELECT m1.id FROM actors a1,movies m1,roles r1 WHERE a1.id=r1.actor_id AND m1.id=r1.movie_id AND a1.first_name='Kevin' AND last_name='Bacon');");
$s->execute();
$rows = $s->fetchAll();
?>
<h1>Results for <?php print "$firstname $lastname" ?> </h1>
<?php
if(count($rows)==0)
{
?>
<p>Actor <?php print "$firstname $lastname" ?> is either not an actor or wasn't any films with Kevin Bacon</p>
<?php }
else
{
 ?>
<table>
<caption><p>Films With <?php print "$firstname $lastname" ?> and Kevin Bacon</p></caption>
<tr>
<th>#</th>
<th>Title</th>
<th>Year</th>
</tr>
        <?php foreach ($rows as $rownum => $row){ ?>
          <tr>
			<td><?php print $rownum+1; ?></td>
            <td><?php print $row['name']; ?></td>
			<td><?php print $row['year']; ?></td>
          </tr>
        <?php  }?>
      </table>
    </form>     
<?php } include("bottom.html"); ?>