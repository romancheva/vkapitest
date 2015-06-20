<?php
$id = 1;
if (isset($_GET["id"]) && $_GET["id"] != ""){
    $id = $_GET["id"];
}
$response = file_get_contents("https://api.vk.com/method/users.get?v=5.8&user_id={$id}&fields=sex,age,bdate,first_name,last_name,photo_200_orig,status,bdate,personal,langs,city,country,occupation,name,connections,personal,education,universities,schools,quotes");
$profile = json_decode($response, true) ["response"][0];

$images = file_get_contents("http://api.vk.com/method/photos.get?v=5.34&owner_id={$id}&album_id=wall&count=5&rev=1&extended=1");
$images = json_decode($images, true) ["response"];

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
    <div class="row">
        <div class="col-sm-12"><?= $profile["first_name"] ?> <?= $profile["last_name"] ?></div>
        <div class="col-sm-offset-2 col-sm-3">
            <div>
                <img src="<?= $profile["photo_200_orig"] ?>">
            </div>
            <div>

            </div>
        </div>
        <div class="col-sm-6">
            <div>
                <div><?= $profile["first_name"] ?> <?= $profile["last_name"] ?></div>
                <div><?= $profile["status"] ?></div>
            </div>
            <hr>
            <div>
                <div class="row">
                    <div class="col-sm-5">
                        Birthday:
                    </div>
                    <div class="col-sm-7">
                        <?= date('F j, Y', strtotime($profile['bdate'])) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        Company:
                    </div>
                    <div class="col-sm-7">
                        <a href="https://vk.com/search?c[name]=0&c[section]=people&c[company]=<?= $profile["occupation"]["name"] ?>"><?= $profile["occupation"]["name"] ?></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        Languages:
                    </div>
                    <div class="col-sm-7">
                        <?= join(', ', $profile['personal']["langs"]) ?>
                    </div>
                </div>

            </div>
            <hr>
            <div>
                <div class="row">
                    <div class="col-sm-5">
                        Current city:
                    </div>
                    <div class="col-sm-7">
                        <a href="https://vk.com/search?c[name]=0&c[section]=people&c[country]=<?= $profile["country"]["title"] ?>&c[city]=<?= $profile["city"]["title"] ?>"><?= $profile["city"]["title"] ?></a>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-sm-5">
                        Twitter:
                    </div>
                    <div class="col-sm-7">
                        <a href="http://twitter.com/<?= $profile["twitter"] ?>"><?= $profile["twitter"] ?></a>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-sm-5">
                        Instagram:
                    </div>
                    <div class="col-sm-7">
                        <a href="http://instagram.com/<?= $profile["instagram"] ?>"><?= $profile["instagram"] ?></a>
                    </div>
                </div>
            </div>
            <hr>

            <div>
                <div class="row">
                    <div class="col-sm-5">
                        Political views:
                    </div>
                    <div class="col-sm-7">
                        <p><? if ($profile["personal"]["political"] == 1)
                                echo "Communist";
                            elseif ($profile["personal"]["political"] == 2)
                                echo "Socialist";
                            elseif ($profile["personal"]["political"] == 3)
                                echo "Moderate";
                            elseif ($profile["personal"]["political"] == 4)
                                echo "Liberal";
                            elseif ($profile["personal"]["political"] == 5)
                                echo "Conservative";
                            elseif ($profile["personal"]["political"] == 6)
                                echo "Monarchist";
                            elseif ($profile["personal"]["political"] == 7)
                                echo "Ultraconservative";
                            elseif ($profile["personal"]["political"] == 8)
                                echo "Apathetic";
                            elseif ($profile["personal"]["political"] == 9)
                                echo "Libertarian";
                            ?></p>
                    </div>
                </div>
            </div>

            <div>
                <div class="row">
                    <div class="col-sm-5">
                        Important in others::
                    </div>
                    <div class="col-sm-7">
                        <a href="http://instagram.com/<?= $profile["instagram"] ?>">
                            <? if ($profile["personal"]["people_main"] == 1)
                                echo "intellect and creativity";
                            elseif ($profile["personal"]["people_main"] == 2)
                                echo "kindness and honesty";
                            elseif ($profile["personal"]["people_main"] == 3)
                                echo "health and beauty";
                            elseif ($profile["personal"]["people_main"] == 4)
                                echo "wealth and power";
                            elseif ($profile["personal"]["people_main"] == 5)
                                echo "courage and persistence";
                            elseif ($profile["personal"]["people_main"] == 6)
                                echo "humor and love for life";
                            ?></a>
                    </div>
                </div>
            </div>
            <hr>
            <? foreach($profile["universities"] as $key => $val): ?>
            <div>
                <div class="row">
                    <div class="col-sm-5">
                        College or university:
                    </div>
                    <div class="col-sm-7">
                        <a href="https://vk.com/search?c[name]=0&c[section]=people&c[uni_country]=<?= $val["country"] ?>&c[uni_city]=<?= $val["city"] ?>&c[university]=<?= $val["name"] ?>"><?= $val["name"] ?></a>
                    </div>
                </div>

            </div>
            <? endforeach ?>

            <? foreach ($profile["schools"] as $key => $val): ?>
                <div class="row">
                    <div class="col-sm-5">
                        <? if ($val['type_str']): ?>
                            <?= $val['type_str'] ?>:
                        <? else: ?>
                            School:
                        <? endif ?>
                    </div>
                    <div class="col-sm-7">
                        <div>

                            <a href="https://vk.com/search?c[name]=0&c[section]=people&c[school_country]=<?= $val["country"] ?>&c[city]=<?= $val["city"] ?>&c[school]=<?= $val["name"] ?>">
                                <?= $val["name"] ?></a>
                        </div>

                    </div>
                </div>
            <? endforeach ?>
            <hr>
            <div>
                <div class="row">
                    <div class="col-sm-5">
                        Favorite quotes:
                    </div>
                    <div class="col-sm-7">
                        <p><?= $profile["quotes"] ?></p>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="box-header text-right "><a href="#
                ">See all <?=$images['count']?></a></div>
                <div class="text-center">
                    <? foreach ($images["items"] as $key => $val): ?>
                        <a href="#"> <img src="<?=$val['photo_75']?>"></a>
                    <? endforeach ?>
                </div>
            </div>
            <div class="box">
                <div class="box-header"><a href="#">10 posts</a></div>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>


<!--    <div class="row">-->
<!--        <div class="col-sm-4">-->
<!--            <div class="sss">-->
<!--                <p><a href="https://vk.com/join">Join VK now</a> to stay in touch with</p>-->
<!---->
<!--                <p>Pavel and millions of others.</p>-->
<!---->
<!--                <p>Or <span class="kkk">log in</span>, if you have a <span class="kkk">VK</span> account.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

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