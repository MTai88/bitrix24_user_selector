<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\UI\Extension;

$APPLICATION->SetTitle('Кастомное поле ui.entity-selector: сотрудники по своему фильтру');

Extension::load('mtai.filtered_user_selector');

$fieldUID = 'filtered_user';

// предselected — текущий пользователь с реальными данными
$user = CUser::GetByID((int)CurrentUser::get()->getId())->Fetch();
$selectedUser = null;
if ($user)
{
	$avatar = '';
	if ((int)$user['PERSONAL_PHOTO'] > 0)
	{
		$file = CFile::ResizeImageGet($user['PERSONAL_PHOTO'], ['width' => 100, 'height' => 100], BX_RESIZE_IMAGE_EXACT);
		$avatar = $file['src'] ?? '';
	}
	$selectedUser = [
		'id' => (int)$user['ID'],
		'title' => trim($user['NAME'] . ' ' . $user['LAST_NAME']),
		'avatar' => $avatar,
		'entityId' => 'user',
		'entityType' => 'employee',
	];
}
?>
<div class="container">
	<h2>Селектор сотрудников с фильтром</h2>

	<p>
		Поле построено на <code>ui.entity-selector</code> (TagSelector). В диалоге два источника:
		штатная сущность <code>user</code> (все сотрудники) и <code>user-filtered</code> —
		собственный провайдер <code>UserFilteredProvider</code>, который наследует штатный
		<code>UserProvider</code> и добавляет к запросу фильтр (демо: должность «Инженер»).
	</p>

	<form method="post">
		<input type="hidden" id="<?= $fieldUID ?>_val" name="employee"
			   value="<?= (int)($selectedUser['id'] ?? 0) ?>"/>
		<div id="<?= $fieldUID ?>"></div>
	</form>
</div>

<script>
	(function () {
		BX.Mtai.FilteredUserSelector.Init('<?= $fieldUID ?>', <?= \Bitrix\Main\Web\Json::encode($selectedUser) ?>);
	})();
</script>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
