import {TagSelector} from 'ui.entity-selector';

export class FilteredUserSelector {
    static Init(fieldUID, selectedUser) {
        const field = document.getElementById(fieldUID + '_val');
        const tagSelector = new TagSelector({
            id: fieldUID,
            multiple: false,
            items: selectedUser ? [selectedUser] : null,
            events: {
                onAfterTagAdd: (event) => {
                    const {tag} = event.getData();

                    field.value = tag.id;
                },
                onTagRemove: function (event) {
                    field.value = "";
                },
            },
            dialogOptions: {
                context: 'selectFilteredUser',
                recentTab: false,
                entities: [
                    {
                        id: 'user',
                        'dynamicLoad': false,
                        'dynamicSearch': false,
                        options: {
                            'inviteEmployeeLink': false,
                        }
                    },
                    {
                        // user-filtered: собственный провайдер (UserFilteredProvider).
                        // dynamicSearch: false — список загружается сразу при открытии
                        // диалога, а не только по результатам поиска
                        id: 'user-filtered',
                        'dynamicLoad': true,
                        'dynamicSearch': false,
                    },
                ],
            }
        });
        tagSelector.renderTo(document.getElementById(fieldUID));
    }
}
