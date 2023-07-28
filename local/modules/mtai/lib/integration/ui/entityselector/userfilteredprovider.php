<?php

namespace MTai\Integration\UI\EntitySelector;

use Bitrix\Main\Entity\Query;
use Bitrix\Main\Loader;
use Bitrix\Socialnetwork\Integration\UI\EntitySelector\UserProvider;

Loader::includeModule("socialnetwork");

class UserFilteredProvider extends UserProvider
{
    public function __construct(array $options = [])
    {
        $options['inviteEmployeeLink'] = false;

        parent::__construct($options);
    }

    protected static function getQuery(array $options = []): Query
    {
        $query = parent::getQuery($options);

        // Your filter here
        //$query->where('WORK_POSITION', 'engineer');

        return $query;
    }
}
