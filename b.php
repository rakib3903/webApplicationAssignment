<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body class="p-3 mb-2 bg-primary-subtle text-emphasis-primary">

  <?php
    $users = json_decode(file_get_contents("file.json"), true);
      $item = $_REQUEST['id'];
      $x = 1;
      $id = 1;
      foreach($users as $key => $u){
          if($item == $u['isbn']){
            $x = $u;
            $id = $key;
            break;
          }
        }
        $u = $x;
  ?>
        
  <h1 class = "text-bg-info p-3" style="text-align: center;">Book Information</h1>
    <div class="mb-3 row m p-3 mb-2 bg-primary-subtle text-emphasis-primary" style="width: 50%; text-align: center; margin:auto; margin-top: auto;">
      <form  method = "post" action ="a.php">
        <input class="form-control" type="text", name = "title"  value = <?php echo $u['title']?> ><br>
        <input class="form-control" type="text" name="author" value= <?php echo $u['author']?>><br>
        <input class="form-control" type="text" name="available" value = <?php echo $u['available']?>><br>
        <input class="form-control" type="text" name="pages" value = <?php echo $u['pages']?>><br>
        <input class="form-control" type="text" name="isbn" value = <?php echo $u['isbn']?>><br>
        <input class="form-control" type="hidden" name="it" value = <?php echo $id ?>><br>
        <button type="submit" name = "update" class="btn btn-outline-primary">submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>