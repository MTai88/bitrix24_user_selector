<?php

use Bitrix\Main\Loader;

// Автозагрузка класса провайдера: неймспейс MTai\* не соответствует ID модуля,
// поэтому штатный модульный автозагрузчик его не находит — без этой регистрации
// ui.entity-selector молча отбрасывает сущность user-filtered
Loader::registerAutoLoadClasses(null, [
    'MTai\Integration\UI\EntitySelector\UserFilteredProvider'
        => '/local/modules/mtai/lib/integration/ui/entityselector/userfilteredprovider.php',
]);
