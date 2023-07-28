### Custom bitrix24 user selector field

### Usage

- Copy `/local/js/mtai/filtered_user_selector/` to your project
- Add selector options in `.settings.php` your module

```
'ui.entity-selector' => [
        'value' => [
            'entities' => [
                [
                    'entityId' => 'user-filtered',
                    'provider' => [
                        'moduleId' => 'mtai',
                        'className' => '\\MTai\\Integration\\UI\\EntitySelector\\UserFilteredProvider'
                    ],
                ],
            ],
            'extensions' => ['socialnetwork.entity-selector'],
        ],
        'readonly' => true,
    ]
```

- Copy provider class `/local/modules/mtai/lib/integration/ui/entityselector/userfilteredprovider.php` to your module & fix namespaces
- Add your own filter to users search query in `getQuery` method of `UserFilteredProvider` class
- see an example usage in `/example/index.php`