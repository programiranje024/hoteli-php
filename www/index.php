<?php
  require_once( 'db-config.php' );

  // Get all hotels
  $sql = 'SELECT * FROM hotel';
  $query = $pdo->prepare( $sql );
  $query->execute();
  $hoteli = $query->fetchAll( PDO::FETCH_ASSOC );
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hoteli PHP</title>
  </head>
  <style>
    form {
      display: flex;
      flex-direction: column;
      width: 50%;
      gap: 1rem;
    }

    p.error {
      color: red;
      margin: 0;
    }

    p.error:empty {
      display: none;
    }

    input.error,
    select.error {
      border: 1px solid red;
    }
  </style>
  <body>
    <form>
      <select id='id_hotel' name='id_hotel' required>
        <?php foreach ( $hoteli as $hotel ) : ?>
          <option value='<?php echo $hotel['id_hotel']; ?>'><?php echo $hotel['name']; ?></option>
        <?php endforeach; ?>
      </select>
      <p class='error' id='id_hotel_error'></p>
      <textarea id='comment' name='comment' required></textarea>
      <p class='error' id='comment_error'></p>
      <input id='submit' type='submit' value='Submit'>
      <p class='error' id='submit_error'></p>
    </form>
    <script src="/js/comment.js"></script>
  </body>
</html>
