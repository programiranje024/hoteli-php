<?php
  require_once( 'db-config.php' );

  // Get all comments
  $sql = 'SELECT * FROM comment ORDER BY id_comment DESC';
  $query = $pdo->prepare( $sql );
  $query->execute();
  $comments = $query->fetchAll( PDO::FETCH_ASSOC );
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hoteli PHP</title>
  </head>
  <body>
    <ul>
      <?php foreach( $comments as $comment ): ?>
          <a href="marks.php?id=<?php echo $comment['id_comment']; ?>">
            <?php echo $comment['comment']; ?>
          </a>
          <hr />
      <?php endforeach; ?>
  </body>
</html>
