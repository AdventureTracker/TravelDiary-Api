/**
 * Created by jakub on 22.03.2016.
 */

var spinner = '<tfoot><tr><th class="center"><div class="preloader-wrapper big active"><div class="spinner-layer spinner-blue-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div></th></tr></tfoot>';
var error_table = '<tfoot><tr><th class="center"><i class="material-icons large">sentiment_dissatisfied</i> <br> Unable to load data </th></tr></tfoot>';

function reloadTable(table) {

	var q = '';
	var filter = $(table.data('filter'));

	if (filter.length)
		q = filter.val();

	table.html(spinner);

	$.ajax({
		url: table.data('source') + '?query=' + q,
		method: 'GET',
		dataType: 'html',
		success: function(data) {
			table.html(data);
		},
		error: function() {
			Materialize.toast("Error while loading trips!", 5000);
			table.html(error_table);
		}
	});
}

$(document).ready(function() {

	$("table[data-source]").delegate('a[data-action]', 'click', function (e) {
		e.preventDefault();

		var table = $(this).parents("table[data-source]");

		$.ajax({
			url: $(this).attr('href'),
			method: 'GET',
			dataType: 'json',
			success: function() {
				reloadTable(table);
			},
			error: function(jqXHR) {
				Materialize.toast(jqXHR.responseJSON.message, 5000);
			}
		});

	});

	$("table[data-source]").each(function () {
		reloadTable($(this));
	});

	$("form.ajax-search").on('submit', function (e) {
		e.preventDefault();
	});

	$("input[type='search'][data-table]").on('change', function (e) {
		e.preventDefault();
		var table = $(this).data('table');
		reloadTable($(table));
	});

	$("table[data-source]").delegate('ul.pagination a', 'click', function (e) {
		e.preventDefault();

		var table = $(this).parents("table[data-source]");

		table.data('source', $(this).attr('href'));

		reloadTable(table);
	});


	$("body").delegate('a[data-modal]', 'click', function (e) {
		e.preventDefault();

		var modal = $($(this).data('modal'));
		
		
		

		$.ajax({
			url: $(this).attr('href'),
			method: 'GET',
			dataType: 'html',
			success: function(data) {
				modal.html(data);
				modal.openModal();
			},
			error: function() {
				Materialize.toast("Error while loading trips!", 5000);
				modal.html("Shit happens!");
			}
		});

	})

	
});