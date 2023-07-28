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
                        id: 'user-filtered',
                        'dynamicLoad': true,
                        'dynamicSearch': true,
                    },
                ],
            }
        });
        tagSelector.renderTo(document.getElementById(fieldUID));
    }
}