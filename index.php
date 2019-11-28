<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">

    <title>Blog</title>

 <?php   

    $user = 'root';
    $password = '';

    $pdo = new PDO('mysql:host=localhost;dbname=blog', $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ]);
    
    
    $stmt = $pdo->query('SELECT * FROM `posts`');
    foreach($stmt->fetchAll() as $x) {
    //var_dump($x);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
 

    $created_by =  htmlentities($_POST['created_by'] ?? '');
    $created_at = htmlentities($_POST['created_at'] ?? '');
    $post_title = htmlentities($_POST['post_title'] ?? '');
    $post_text = htmlentities($_POST['post_text'] ?? '');
    $post_url = htmlentities($_POST['post_url'] ?? '');

    $stmt = $pdo->prepare("INSERT INTO `posts` (created_by, created_at, post_title, post_text, post_url) VALUES (:by, now(), :on, :text, :url)");
    $stmt->execute([':by' => $created_by, ':on' => $post_title, ':text' => $post_text, ':url' => $post_url]);
    }


?>


</head>
<body>
    <div class="container">
    <header>
        BLJ-BLOG
    </header>

<nav class="nav">
    <h1>Andere BLJ Blogs</h1>
        <ul>
            <li>Alessio Vangelisti</li>
            <li>Darwin Windlin</li>
            <li>Davide Trinkler</li>
            <li>Erin Bachmann</li>
            <li>Joshua Odermatt</li>
            <li>Marvin Purtschert</li>
            <li>Moritz Wicki</li>
            <li>Nicola Fioretti</li>
        </ul>

</nav>

    <main>
        <h2>Schreibe einen Eintrag</h2>
            <form action="index.php" method="POST">

                <div class="form-field-name">
                     <label for="name">Name</label>
                     <input type="text" id="created_by" name="created_by">
                </div>

                <div class="form-field-titel">
                    <label for="titel">Titel</label>
                    <input type="text" id="post_title" name="post_title">
                </div>

                <div class="form-field-text">
                    <label for="message">Nachricht</label>
                    <textarea type="text" id="post_text" name="post_text"></textarea>
                </div>

                <div class="form-field-url">
                    <label for="url">Bild</label>
                    <textarea htmlentities type="text" id="post_url" name="post_url"></textarea>
                </div>
                

                <input class="senden-knopf" type="submit" value="Veröffentlichen">

            </form>

        

    </main>
    <aside class="aside">
            <h3>Beiträge</h3>
            
            <?php
            $sql = "SELECT created_at, created_by, post_title, post_text, post_url FROM posts";
            $sql = "SELECT * FROM posts ORDER BY created_at desc";
                foreach ($pdo->query($sql) as $row) {?>
                    <div class="beitrag">
                    <?php
                    echo "Titel: ";
                    echo $row['post_title']."<br />";
                    echo "Text: ";
                    echo $row['post_text']."<br />";
                    echo "geschrieben von: ";
                    echo $row['created_by']."<br />";
                    echo "geschrieben am: ";
                    echo $row['created_at']."<br />" ;
                    echo "<img class='pictures' src='{$row['post_url']}'>";
                    ?>

                    </div>
                    <?php
                }
            ?>
            


    </aside>



</div>


</body>
</html>