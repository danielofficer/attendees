<!DOCTYPE html>
<html>
<head>
    <title><?=$pageTitle?></title>
</head>

<body>

    <h1><a href="/">Event</a></h1>

    <?php if (!empty($_SESSION['flash'])) { ?>
        <div id="flash">
            <p><?=htmlentities($_SESSION['flash'])?></p>
        </div>
        <?php $_SESSION['flash'] = null; ?>
    <?php } ?>

    <h2><?=$pageTitle?></h2>

    <div id="content">
