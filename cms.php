<!--
 * Cytonn Technologies
 *
 * @author: Hashim Amani <hamani@cytonn.com>
 *
 * Project: PHP OOP.
 *
 */ -->



<?php

class CMS {
  var $host;
  var $username;
  var $password;
  var $table;


  //select fro database and display

public function display_public() {

    $q = "SELECT * FROM testDB ORDER BY created DESC LIMIT 3";
    $r = mysql_query($q);

    if ( $r !== false && mysql_num_rows($r) > 0 ) {
      while ( $a = mysql_fetch_assoc($r) ) {
        $title = stripslashes($a['title']);
        $bodytext = stripslashes($a['bodytext']);

        $entry_display .= <<<ENTRY_DISPLAY

    <h2>$title</h2>
    <p>
      $bodytext
    </p>


ENTRY_DISPLAY;
      }
    } else {
      $entry_display = <<<ENTRY_DISPLAY

    <h2>Page under construction</h2>
    <p>
     add an entry to help me out.
    </p>

ENTRY_DISPLAY;
    }
    $entry_display .= <<<ADMIN_OPTION

    <p class="admin_link">
      <a href="{$_SERVER['PHP_SELF']}?admin=1">Add a New Entry</a>
    </p>

ADMIN_OPTION;

    return $entry_display;
    
  }


  //display a frorm for input.

public function display_admin() {

     return <<<ADMIN_FORM

    <form action="{$_SERVER['PHP_SELF']}" method="post">
      <label for="title">Title:</label>
      <input name="title" id="title" type="text" maxlength="150" />
      <label for="bodytext">Body Text:</label>
      <textarea name="bodytext" id="bodytext"></textarea>
      <input type="submit" value="Create This Entry!" />
    </form>

ADMIN_FORM;
    
  }

  //insert to database after input

  public function write($p) {

    if ( $p['title'] )

    $title = mysql_real_escape_string($p['title']);

    if ( $p['bodytext'])

    $bodytext = mysql_real_escape_string($p['bodytext']);

    if ( $title && $bodytext ) {

      $created = time();

      $sql = "INSERT INTO testDB VALUES('$title','$bodytext','$created')";

      return mysql_query($sql);

    } else {
      return false;
    }
    
  }
   
   // connect to database 
public function connect() {

      mysql_connect($this->host,$this->username,$this->password) or die("

        Could not connect. " . mysql_error());

      mysql_select_db($this->table) or die("Could not select database. " .
       
      mysql_error());



    return $this->buildDB();
}
    

//create a table if it doesnt exist
private function buildDB() {

        $sql = <<<MySQL_QUERY

            CREATE TABLE IF NOT EXISTS testDB (
                title VARCHAR(150),
                bodytext  TEXT,
                created VARCHAR(100)
                )
MySQL_QUERY;

return mysql_query($sql);

}
        
      
}

?>