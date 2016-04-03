/**
 * Created by jakub on 22.03.2016.
 */

function reloadTable(table) {
	$.ajax({
		url: table.data('source'),
		method: 'GET',
		dataType: 'html',
		success: function(data) {
			table.html(data);
		},
		error: function() {
			Materialize.toast("Error while loading trips!", 5000);
		}
	});
}

$(document).ready(function() {
	
	$("table[data-source]").each(function () {
		reloadTable($(this));
	})
	
});