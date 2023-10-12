<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Lists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="p-3 mb-2 bg-primary-subtle text-emphasis-primary">
    <h1 class = "text-bg-info p-3" style="text-align: center;">Book Lists</h1>
    <div class="mb-3 row m p-3 mb-2 bg-primary-subtle text-emphasis-primary" style="width: 50%; text-align: center; margin:auto;">
        <form action="a.php" method="post">
            <input class="form-control" type="text", name = "book_search" placeholder="enter book title" required><br>
            <button type="submit" name = "search" class="btn btn-outline-primary">search</button>
        </form>
    </div>
    <div style="padding-bottom:10px">
        <form action="a.html">
            <button class="btn btn-outline-success">add book</button>
        </form>
    </div>
    
    <?php
    $json = file_get_contents("file.json", true);
    $users = json_decode($json, true);

    if (isset($_POST["add_book"])) {
        $id = $_POST["title"];
        $name = $_POST["author"];
        $author = $_POST["available"];
        $include = $_POST["pages"];
        $isbn = $_POST['isbn'];
        $a = [
            "title" => $id,
            "author" => $name,
            "available" => $author,
            "pages" => $include,
            "isbn" =>$isbn

        ];
        array_push($users, $a);
        $p = json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents("file.json", $p);

    }
    if (isset($_POST["delete"])) {
        $item = $_POST['id'];
        foreach($users as $key => $u){
            if($item == $u['isbn']){
               unset($users[$key]);
               break;
            }
        }  
        $p = json_encode($users);
        file_put_contents("file.json", $p);
    }

    if (isset($_POST["search"])) {
        echo "<h4 style='text-align:center'>Availability of searched book</h4>";
        echo "<div style = 'text-align:center; margin-bottom:5%;display:flex; justify-content: center;'>";
            echo "<table border = '1' style = 'width:50%; text-align:center'>";
                echo "<tr>";
                    echo "<th>"; echo "Book Title"; echo "</td>";
                    echo "<th>"; echo "Book Author"; echo "</td>";
                    echo "<th>"; echo "Availability"; echo "</td>";
                    echo "<th>"; echo "Pages"; echo "</td>";
                    echo "<th>"; echo "Isbn"; echo "</td>";
                echo "</tr>";
                foreach ($users as $u) {
                    if ($u['title'] == $_POST['book_search']){
                        echo "<tr>";
                        echo "<td>" . $u['title'] . "</td>";
                        echo "<td>" . $u['author'] . "</td>";
                        echo "<td>" . $u['available'] . "</td>";
                        echo "<td>" . $u['pages'] ."</td>";
                        echo "<td>" . $u['isbn'] ."</td>";
                        echo "</tr>";
                    }
                }

            echo "</table>";
        echo "</div>";   
    }

    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Book Title</th>";
    echo "<th>Author</th>";
    echo "<th>Available</th>";
    echo "<th>Pages</th>";
    echo "<th>Isbn</th>";
    echo "<th>Delete</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody class='table-group-divider'>";
    foreach ($users as $u) {
        echo "<tr>";
        echo "<td>" . $u['title'] . "</td>";
        echo "<td>" . $u['author'] . "</td>";
        echo "<td>" . $u['available'] . "</td>";
        echo "<td>" . $u['pages'] . "</td>";
        echo "<td>" . $u['isbn'] . "</td>";
        echo "<td>";
        echo " <form method = 'post'>";
        echo "<input  type='hidden' name='id' class='btn btn-outline-danger' value = '".$u['isbn']."'>";
        echo "<button name='delete' class='btn btn-outline-danger'>delete</button>";
        echo "</form>". "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>