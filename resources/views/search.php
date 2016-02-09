<?php require_once 'header.php' ?>

    <form action="/search" method="post">
        <input type="text" name="searchBox" />
        <input type="hidden" name="xtoken" value="<?=$_SESSION['xtoken']?>" />
        <input type="submit" value="Search">
    </form>

<?php if (isset($errorMessage)) { ?>
    <p><?=$errorMessage?></p>
<?php } ?>

<?php if (!empty($attendees)) { ?>
    <ul>
    <?php
    /**
     * @var \Model\Attendee[] $attendees
     */
    foreach ($attendees as $attendee) { ?>
        <li><a href="/attendee?id=<?=$attendee->getId()?>"><?=$attendee->getFirstName()?> <?=$attendee->getLastName()?></a></li>
    <?php } ?>
    </ul>
<?php } ?>

<?php require_once 'footer.php' ?>
