<?php
  require_once( '../db-config.php' );

  $id_hotel = $_POST['id_hotel'];
  $comment = $_POST['comment'];

  // Check if we have a valid comment, min 10 chars
  if ( !isset( $comment ) || strlen( $comment ) < 10 ) {
    http_response_code( 400 );
    echo 'comment is required';
    exit;
  }

  // We don't need to check the hotel, because that check is done by the database
  // We can just insert the comment and the hotel id
  $sql = 'INSERT INTO comment ( id_hotel, comment ) VALUES ( :id_hotel, :comment )';
  $query = $pdo->prepare( $sql );

  if ( !$query ) {
    http_response_code( 500 );
    echo 'Could not prepare query!';
    exit;
  }

  $query->bindParam( ':id_hotel', $id_hotel, PDO::PARAM_INT );
  $query->bindParam( ':comment', $comment, PDO::PARAM_STR );

  // Try to execute the query
  if ( !$query->execute() ) {
    http_response_code( 500 );
    echo 'Could not insert comment!';
    exit;
  }

  // If we get here, everything went well
  echo 'comment inserted!';
?>
