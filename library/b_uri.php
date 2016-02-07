<?php
global $wpdb;
$b_uri = $_POST['b_uri'];

     $table = 'kot_posts';
     $data = array(
		'b_uri' => stripslashes($b_uri)	// string
                  );
     $where = array( 'ID' => $page_id );

     $wpdb->update( $table, $data, $where, $format = null, $where_format = null );


?>