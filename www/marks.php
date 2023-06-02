<?php
  require_once( 'db-config.php' );

  // Get all comments
  $sql = 'SELECT * FROM comment';
  $query = $pdo->prepare( $sql );
  $query->execute();
  $comments = $query->fetchAll( PDO::FETCH_ASSOC );

  // Get the selected comment
  $id_comment = isset( $_GET['id'] ) ? $_GET['id'] : -1;

  if ( $id_comment == -1 ) {
    echo 'Missing parameter';
    exit;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hoteli PHP</title>
  </head>
  <body>
    <form>
      <label for="mark">Mark:</label>
      <select id="mark" name="mark">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3" selected>3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <input type="hidden" id="id_comment" name="id_comment" value="<?php echo $id_comment; ?>">
      <br>
      <input type="submit" value="Mark">
      <div id="marks"></div>
    </form>
    <script src="/js/marks.js"></script>
  </body>
</html>
