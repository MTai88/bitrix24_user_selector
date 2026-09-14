<?php

namespace MTai\Integration\UI\EntitySelector;

use Bitrix\Main\ORM\Query\Query;
use Bitrix\Main\Loader;
use Bitrix\Socialnetwork\Integration\UI\EntitySelector\UserProvider;

// класс наследует UserProvider модуля socialnetwork: при ленивой
// автозагрузке модуль может быть ещё не подключён — includeModule
// идемпотентен и подключит его по необходимости
Loader::includeModule('socialnetwork');

/**
 * Провайдер ui.entity-selector: сотрудники, отфильтрованные по своему условию.
 *
 * Наследует штатный UserProvider (сотрудники со структурой, аватарами и
 * поиском) и добавляет фильтр к запросу выборки — см. getUserFilter().
 * Регистрируется в .settings.php модуля как сущность 'user-filtered',
 * поэтому в диалоге может сосуществовать со штатной сущностью 'user'.
 */
class UserFilteredProvider extends UserProvider
{
	/**
	 * Условие фильтрации сотрудников: колонки таблицы b_user => значения.
	 * Демо-фильтр стенда — только сотрудники с должностью «Инженер».
	 * Замените на своё условие или переопределите getUserFilter().
	 */
	protected const USER_FILTER = [
		'WORK_POSITION' => 'Инженер',
	];

	public function __construct(array $options = [])
	{
		// у отфильтрованного списка не показываем ссылку «Пригласить сотрудника»
		$options['inviteEmployeeLink'] = false;

		parent::__construct($options);
	}

	protected static function getQuery(array $options = []): Query
	{
		$query = parent::getQuery($options);

		foreach (static::getUserFilter() as $column => $value)
		{
			$query->where($column, $value);
		}

		return $query;
	}

	/**
	 * Точка расширения: условие фильтра для запроса сотрудников.
	 * Ключи — поля таблицы b_user (WORK_POSITION, ACTIVE, EMAIL, ...),
	 * поддерживаются и вложенные поля через точки.
	 *
	 * @return array<string, mixed>
	 */
	protected static function getUserFilter(): array
	{
		return static::USER_FILTER;
	}
}
