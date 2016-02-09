<?php require_once 'header.php' ?>

<?php if (isset($errorMessage)) { ?>
    <p><?=$errorMessage?></p>
<?php } ?>

<?php if (!empty($attendee)) { ?>
    <?php
    /**
     * @var \Model\Attendee $attendee
     */
    /**
     * @var \Model\Company $company
     */
    ?>

    <p>Name: <?=$attendee->getFirstName()?> <?=$attendee->getLastName()?></p>
    <p>Company: <?=$company->getCompanyName()?></p>
    <p>Email Address: <?=$attendee->getEmail()?></p>

    <p><a href="/attendee/delete?id=<?=$attendee->getId()?>">Delete this attendee</a></p>
<?php } ?>

<?php require_once 'footer.php' ?>
