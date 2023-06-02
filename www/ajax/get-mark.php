<?php

require_once( '../db-config.php' );

$id_comment = $_GET['id'];

// Check if we have set the parameters
if( !isset( $id_comment ) ) {
  http_response_code( 400 );
  echo 'Missing parameters';
  exit;
}

// Get the mark for the comment
$sql = 'SELECT * FROM mark WHERE id_comment = :id_comment';
$query = $pdo->prepare( $sql );
$query->execute( [ ':id_comment' => $id_comment ] );

$marks = $query->fetchAll( PDO::FETCH_ASSOC );
$mark = isset( $marks[0] ) ? $marks[0] : [
  'sum' => 0,
  'average_mark' => 0,
  'id_mark' => null,
  'number' => 0,
];

// Return as JSON
header( 'Content-Type: application/json' );
// Get only, average_mark, number and sum
$mark = [
  'average_mark' => $mark['average_mark'],
  'number' => $mark['number'],
  'sum' => $mark['sum'],
];

echo json_encode( $mark );
