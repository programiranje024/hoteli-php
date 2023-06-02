<?php
require_once( '../db-config.php' );

$id_comment = $_POST['id_comment'];
$mark = $_POST['mark'];

// Check if we have set the parameters
if( !isset( $id_comment ) || !isset( $mark ) ) {
  http_response_code( 400 );
  echo 'Missing parameters';
  exit;
}

$mark = intval( $mark );

// Check if mark is between 1 and 5 (inclusive)
if( $mark < 1 || $mark > 5 ) {
  http_response_code( 400 );
  echo 'Mark must be between 1 and 5';
  exit;
}

$mark_value = $mark;

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

// Re-calculating the average mark
$mark['sum'] += $mark_value;
$mark['average_mark'] = $mark['sum'] / ( count( $marks ) + 1 );

// Check if we already have a mark for this comment
if ( is_null( $mark['id_mark'] ) ) {
  $sql = 'INSERT INTO mark ( id_comment, sum, average_mark, number ) VALUES ( :id_comment, :sum, :average_mark, :number )';
  $query = $pdo->prepare( $sql );
  $query->execute( [
    ':id_comment' => $id_comment,
    ':sum' => $mark['sum'],
    ':average_mark' => $mark['average_mark'],
    ':number' => 1,
  ] );

  echo 'Mark inserted';
}
else {
  $sql = 'UPDATE mark SET number = number + 1, sum = :sum, average_mark = :average_mark WHERE id_mark = :id_mark';
  $query = $pdo->prepare( $sql );
  $query->execute( [
    ':sum' => $mark['sum'],
    ':average_mark' => $mark['average_mark'],
    ':id_mark' => $mark['id_mark'],
  ] );

  echo 'Mark updated';
}