<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<?php
\Bitrix\Main\UI\Extension::load('mtai.filtered_user_selector');

$fieldUID = "filtered_user";
$selectedUser = [
    "id" => 1,
    "title" => "Faisal Telesphoros",
    "avatar" => "/example/avatar.png",
    "entityId" => "user",
    "entityType" => "employee"
];
?>
    <input type="hidden" id="<?= $fieldUID ?>_val" name="employee"
           value="<?= $selectedUser["id"] ?>"/>
    <div id="<?= $fieldUID ?>"></div>
    <script>
        (function () {
            BX.Mtai.FilteredUserSelector.Init("<?=$fieldUID?>", <?=json_encode($selectedUser)?>);
        })();
    </script>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>