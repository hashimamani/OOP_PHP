<!--
 * Cytonn Technologies
 *
 * @author: Hashim Amani <hamani@cytonn.com>
 *
 * Project: PHP OOP.
 *
 *-->

 <!-- a simple application for adding content in a webpage-->

<html lang="en">

  <head>
    <title>CMS</title>
  </head>

  <body>

		  <?php
		     
				  include_once('cms.php');

				  //instantiate objects from the class cms and connect to db
				  //after connecting display instructions for user.

				  $obj = new CMS();
				  $obj->host = 'localhost';
				  $obj->username = 'root';
				  $obj->password = 'ROOT';
				  $obj->table = 'testDB';
				  $obj->connect();

				  if ( $_POST )
				    $obj->write($_POST);

				  echo ( $_GET['admin'] == 1 ) ? $obj->display_admin() : $obj->display_public();

		?>



  </body>