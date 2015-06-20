<?php
$page = 1;
if (isset($_GET["page"]) && $_GET["page"] != "") {
    $page = $_GET["page"];
}

$limit = 5;
$offset = ($page-1)*$limit;
$response = file_get_contents("https://api.vk.com/method/friends.get?v=5.8&user_id=1&count={$limit}&offset={$offset}&fields=first_name,last_name,photo_max_orig,sex,status,education,university,relation");
$response = json_decode($response, true) ["response"];
$results = $response['items'];
$total = $response['count'];

if ($page == 1){
    $prevLink = "";
}
$prevLink = $page - 1;
$nextLink = $page + 1;

$pages = ceil($total/$limit);



?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catopholio</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/blog.css" rel="stylesheet">
</head>

<body>

<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item active" href="#">Home</a>
            <a class="blog-nav-item" href="#">Gallery</a>
            <a class="blog-nav-item" href="#">Videos</a>
            <a class="blog-nav-item" href="#">Submit</a>
        </nav>
    </div>
</div>

<div class="container">

    <div class="blog-header">
        <h1 class="blog-title">Durov friends</h1>

        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
    </div>

    <div class="row">

        <div class="col-sm-8 blog-main">
            <? foreach ($results as $post): ?>
                <!--                --><? // if ($post["university_name"] != ""): ?>
                <div class="blog-post">
                    <? $id = $post["id"] ?>
                    <h2 class="blog-post-title"><a href="/profile.php?id=<?= $id?>" style="text-decoration: none"> <?= $post['first_name'] ?> <?= $post['last_name'] ?></a></h2>
                    <!--                    <p class="blog-post-meta">sex: -->
                    <? //= $post['sex'] == 1 ? 'female' : 'male'
                    ?><!--</p>-->

                    <p class="blog-post-meta">sex: <? if ($post['sex'] == 1)
                            echo "fimale";
                        elseif ($post['sex'] == 2)
                            echo "male";
                        else
                            echo "not specified";
                        ?></p>

                    <p class="blog-post-meta">user id: <?= $post['id'] ?></p>

                    <p class="blog-post-meta">relation: <?
                        if ($post["relation"] == 1)
                            echo "single";
                        elseif ($post["relation"] == 2)
                            echo "in a relationship";
                        elseif ($post["relation"] == 3)
                            echo "engaged";
                        elseif ($post["relation"] == 4)
                            echo "married";
                        elseif ($post["relation"] == 5)
                            echo "it's complicated";
                        elseif ($post["relation"] == 6)
                            echo "actively searching";
                        elseif ($post["relation"] == 7)
                            echo "in love";
                        else
                            echo "ololo";

                        ?></p>

                    <p class="blog-post-meta">status: <?= $post["status"] ?></p>

                    <p class="blog-post-meta">university_name: <?= $post["university_name"] ?></p>

                    <p class="blog-post-meta">graduation: <?= $post["graduation"] ?></p>

                    <a href="/profile.php?id=<?= $id?>"><img src="<?= $post['photo_max_orig'] ?>" title="Link to profile" /></a>
                </div>
                <!--            --><? // endif ?>
            <? endforeach ?>

            <nav>
                <ul class="pagination">

                    <? if ($prevLink != ""): ?>
                        <li>
                            <a href="/friends.php?page=<?= $prevLink ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <? endif ?>
                    <li>
                        <? if($nextLink <= $pages): ?>
                        <a href="/friends.php?page=<?= $nextLink ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        <? endif ?>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module">
                <h4>Elsewhere</h4>
                <ol class="list-unstyled">
                    <li><a href="#">GitHub</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                </ol>
            </div>
        </div>

    </div>
</div>
<footer class="blog-footer">
    <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a
            href="https://twitter.com/mdo">@mdo</a>.</p>

    <p>
        <a href="#">Back to top</a>
    </p>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>


</body>
</html>