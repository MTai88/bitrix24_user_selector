this.BX = this.BX || {};
(function (exports, entitySelector) {
	"use strict";

	var TagSelector = entitySelector.TagSelector;

	function FilteredUserSelector() {}

	FilteredUserSelector.Init = function (fieldUID, selectedUser) {
		var field = document.getElementById(fieldUID + '_val');
		var tagSelector = new TagSelector({
			id: fieldUID,
			multiple: false,
			items: selectedUser ? [selectedUser] : null,
			events: {
				onAfterTagAdd: function (event) {
					var tag = event.getData().tag;
					field.value = tag.id;
				},
				onTagRemove: function (event) {
					field.value = "";
				}
			},
			dialogOptions: {
				context: 'selectFilteredUser',
				recentTab: false,
				entities: [
					{
						id: 'user',
						dynamicLoad: false,
						dynamicSearch: false,
						options: {
							inviteEmployeeLink: false
						}
					},
					{
						// user-filtered: собственный провайдер (UserFilteredProvider).
						// dynamicSearch: false — список загружается сразу при открытии
						// диалога, а не только по результатам поиска
						id: 'user-filtered',
						dynamicLoad: true,
						dynamicSearch: false
					}
				]
			}
		});
		tagSelector.renderTo(document.getElementById(fieldUID));
	};

	exports.FilteredUserSelector = FilteredUserSelector;
})(this.BX.Mtai = this.BX.Mtai || {}, BX.UI.EntitySelector);
