<?php
require "./db/connection.php";
if (isset($_POST['chapterSearch'])) {
    $questionQ = $conn->prepare("select * from questions where chapter = :chapter");
    $questionQ->bindValue(':chapter',htmlentities($_POST['chapterName']));
    $questionQ->execute();
    $questions = $questionQ->fetchAll();
    $alp = ['A', 'B', 'C', 'D'];
} else {
    $chaptersQ = $conn->prepare('select distinct chapter from questions');
    $chaptersQ->execute();
    $chapters = $chaptersQ->fetchAll();
}
// print_r($questions);
?>






<!doctype html>
<html lang="en">

<head>
    <title>Quiz Contest</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.9/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.9/highlight.min.js"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.min.css">
</head>

<body>

    <?php if (!isset($_POST['chapterSearch'])) : ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container body-pos">
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <label for="chapterName">Chapter</label>
                        <select class="custom-select" name="chapterName" id="chapterName">
                            <?php foreach ($chapters as $chapter) : ?>
                                <option value="<?= $chapter['chapter'] ?>"><?= $chapter['chapter'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="submit" name="chapterSearch" value="Search" class="btn btn-outline-primary">
                </div>
            </div>

        </div>
        </form>
    <?php endif; ?>
    <?php
    if (isset($_POST['chapterSearch'])) : ?>
        <form id="mainForm" action="" method="post"></form>
        <div class="container">
            <?php $count = 1;
            foreach ($questions as $question) : ?>
                <div class="row animated <?php if ($count != 1) {
                                                echo "dis-none fadeOut";
                                            } else {
                                                echo "fadeIn";
                                            } ?>">
                    <div class=" col-md body-pos">
                        <div class="row mb-5 <?php if ($question['code'] == '') {
                                                    echo 'width-56';
                                                } ?>">
                            <h2><span id="count"><?php echo $count . '</span>' . '. ' . $question['question']; ?></h2>
                        </div>
                        <?php for ($i = 1; $i <= 4; $i++) :
                            if ($question['op' . $i] == '') {
                                break;
                            } ?>
                            <div class="row width-option mt-4 border option-box py-1" <?php if ($question['code'] == '') {
                                                                                            echo 'style = "width:40%"';
                                                                                        } ?>>
                                <div class="col-1 border ml-2 p-0 text-center option-no">
                                    <span class="text-center"><?= $alp[$i - 1] ?></span>
                                </div>
                                <div class="col-9"><?= $question['op' . $i] ?> </div>
                                <div class="col-1 hide check"><i class="fas fa-check"></i></div>
                                <input type="hidden" name="<?= 'q' . $count ?>" id="" value="<?= $i ?>">
                            </div>
                        <?php endfor; ?>
                        <div class="row mt-4">
                            <?php if ($count != 1) : ?>
                                <button id="next" type="button" onclick="pre(this)" class="btn btn-outline-primary px-5 mr-3">Pre</button>
                            <?php endif; ?>
                            <?php if ($count != count($questions)) { ?>
                                <button type="button" onclick="next(this)" class="btn btn-outline-primary px-5">Next</button>
                            <?php } else { ?>
                                <button type="button" onclick="submit(this)" class="btn btn-outline-success px-5 ml-3">Sumiit</button>
                            <?php } ?>
                        </div>
                    </div>

                    <?php if ($question['code'] != '') : ?>
                        <div class="col-md pl-5 pt-5" style="margin-top:12%; margin-bottom:-1%; background-color:#F0F0F0">
                            <pre><code class = "c++"><?= $question['code'] ?></code></pre>

                        </div>
                    <?php endif; ?>
                </div>
                <?php
                $count++;
            endforeach; ?>

            <div class="row">
                <div class='dis-none animated body-pos'>
                    <h3>You Scored: <span id='res'></span>/<?= $count - 1 ?></h3>
                    <!-- <button type="button" onclick="location.reload()" class="btn btn-outline-primary mt-5 ml-1 px-4">Repeat</button> -->
                    <a name="" id="" class="btn btn-outline-primary mt-5 ml-1 px-4" href="index.php" role="button">Repeat</a>
                </div>
            </div>
        </div>
        </form>
    <?php endif; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4fd65c465f.js"></script>
</body>

</html>