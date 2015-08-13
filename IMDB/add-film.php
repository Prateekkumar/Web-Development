 <!--
* Name: Prateek Kumar
* Description: MyMDb (add-film.php)
-->
 
  <?php
 include("top.html"); 

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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	
    
      
    
      $genere = $_POST['genere'];
      $id_movie = $_POST['id_movie'];
      $year_movie = $_POST['year_movie'];
      $rank_movie = $_POST['rank_movie'];
     
      $dirname = $_POST['dirname'];
      $lastdirname = $_POST['lastdirname'];
      $fname = $_POST['firstname'];
      $lname1 = $_POST['lastname'];
      $firstname_2 =$_POST['firstname2'];
      $lastname_2 = $_POST['lastname2'];
      
      $flag = 0;
      if($fname == "")
      {
      	print("<p>First name is not filled</p>");
      }
	
	 if($lname1 == "")
        {
          print("<p>Last name is not filled</p>");
        }
	
	 if($firstname_2 == "")
        {
         print("<p>First name second actor  is not filled</p>");
        }
	
	 if($lastname_2 == "")
 	  {
 	    print("<p>Last name of second actor  is not filled</p>");
 	  }
	
	 if($dirname == "")
	  {
	    print("<p>First name of the director is not filled</p>");
 	 }
	
	 if($lastdirname == "")
 	  {
 	    print("<p>Last name of the director  not filled</p>");
 	  }
	 if($genere == "")
        {
          print("<p>Genere is not filled</p>");
        }

	 if($id_movie == "")
        {
          print("<p>Movie Id is not filled</p>");
        }

 if($year_movie == "")
        {
         print("<p>Movie year  is not filled</p>");
        }

 if($rank_movie == "")
        {
         print("<p>Movie rank is not filled</p>");
        }
    
else{

if (! preg_match ("/^[0-9][0-9][0-9][0-9]$/", $year_movie)){
print ("<p> Enter a valid year </p>");
$flag =1;
}
 if (! preg_match ("/^\s*[0-9]*[1-9]+[0-9]*\s*$/", $id_movie)) {
            print ("<p>ID is not in correct format</p>");
 $flag =1;
          } 


    $result1 = $db->query(" select id from directors where first_name = '$dirname' and last_name = '$lastdirname';");

    $result2 = $db->query(" select genre from directors_genres where genre = '$genere';");

   if($flag == 0){
  $s = $db->prepare ("insert into movies values (:id,:name,:year,:rank);");
 $s->bindParam (":id", $id_movie);
            $s->bindParam (":name", $moviename);
            $s->bindParam (":year", $year_movie);
            $s->bindParam (":rank", $rank_movie);
            try {
              $s->execute();
             print ("<p> Movie Insertion Complete </p>");
            } catch (PDOException $e) {
              print ("<p>Error inserting </p>");
              
            }

}
}
}?>
<form action="" method="Post">
<label>Filmname: <input type="text" name="Filmname" maxlength="100" /></label><br />
<label>Actor1 Firstname:<input type="text" name="firstname" maxlength="100"/></label></br>
<label>Actor1 Lastname:<input type="text" name="lastname" maxlength="100"/></label><br />
<label>Actor2Firstname:<input type="text" name="firstname2" maxlength="100"/></label></br>
<label>Actor2LastName:<input type="text" name="lastname2" maxlength="100"/></label><br />
<label>DirectorFirstName: <input type="text" name="dirname" maxlength="100"/></label></br>
<label>DirectorLastName: <input type="text" name="lastdirname" maxlength="100"/></label><br />
<label>Genre: <input type="text" name="genere" maxlength="100"/></label><br />
<label>Movie ID: <input type="text" name="id_movie" maxlength="100"/></label><br />
<label>Year: <input type="text" name="year_movie" maxlength="4"/></label><br />
<label>Movie Rank: <input type="text" name="rank_movie" maxlength="4"/></label><br />
<input type="submit" name="insert" value="Insert" />
</form>
<?php include("bottom.html");
  ?>
