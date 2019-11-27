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
    var_dump($x);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
 

    $created_by = $_POST['created_by'] ?? '';
    $created_at = $_POST['created_at'] ?? '';
    $post_title = $_POST['post_title'] ?? '';
    $post_text = $_POST['post_text'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO `posts` (created_by, created_at, post_title, post_text) VALUES (:by, now(), :on, :text)");
    $stmt->execute([':by' => $created_by, ':on' => $post_title, ':text' => $post_text]);
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
                

                <input type="submit" value="Veröffentlichen">

            </form>

        

    </main>
    <aside class="aside">
            <h3>Beiträge</h3>

            <?php
            if($post_text != '' || $post_title != ''|| $created_by != '' ){ ?>
            <ul class="ausgabe">
            <li>$post_title</li>
            <li>$post_text</li>
            <li>$created_by</li>
            <li>$created_at</li>
            </ul>"
            <?}?>

    </aside>



</div>


</body>
</html>