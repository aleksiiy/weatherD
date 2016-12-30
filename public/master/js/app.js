/**
 * Setting csrf token header for ajax requests
 */
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

/**
 * table - variable to contain table
 * route - named of route which have to be prepended to links (for edit / delete / update actions)
 */
var table, route, iden, status, folder;
/**
 * Document ready event
 * get table id split it and store in route variable
 * needed for links in formatter
 */
$(document).ready(function () {
	table = $('table.table.table-hover');
	route = table.attr('data-route');
	folder = table.attr('data-folder');
});

function ids(value) {
	return iden = value;
}
/**
 * Query params function for server side pagination
 *
 * @param params
 * @returns {{limit: *, offset: *, search: *}}
 */
function queryParams(params) {
	return {
		limit: params.limit,
		offset: params.offset,
		search: params.search
	};
}
/**
 * Formatter for tale actions button
 * edit/delete
 *
 * @param id
 */
function actions(id) {
	var edit = $('<a title="Редактировать" href="" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a>');
	edit.attr('href', route + '/' + id );
	console.log(route);
	if(route.indexOf('pages') != -1 && $.inArray(id, [1,2,3,4,5,6,7]) !== -1) {
		return '<div class="btn-group">' + edit[0].outerHTML + '</div>';
	} else {
		var del = $(
			'<button title="Удалить" type="button" class="delete btn btn-danger" data-id="' + id + '">' +
			'<span class="glyphicon glyphicon-remove"></span>' +
			'</button>'
		);
		return '<div class="btn-group">' + edit[0].outerHTML + del[0].outerHTML + '</div>';
	}

}

function image(image) {
	return '<img class="icon-img" src="' + folder + '/' + image + '">';
}

/**
 * Prepend font-awesome icon to text
 *
 * @param value
 * @returns {string}
 */
function iconFormatter(value) {
	var iconClass = "fa fa-" + value + " fa-2x";
	return '<i class="' + iconClass + '"aria-hidden="true"></i> ' + value;
}

/**
 * Wrap value into <a> tag
 *
 * @param value
 * @returns {string}
 */
function linkFormatter(value) {
	return '<a href="' + value + '" target="_blank"> Ссылка </a>';
}

/**
 * Deleting record from table
 */
$('body').on('click', '.delete', function(){
	var id = $(this).attr('data-id');
	bootbox.confirm("Вы уверены, что хотите удалить запись?", function(result) {
		if(result) {
			$.ajax({
				url: route + '/' + id,
				type: 'DELETE',
				success: function(){
					table.bootstrapTable('refresh');
				},
				error: function(error){
					$.jGrowl( "Невозможно удалить запись", {
						sticky:false,
						theme: "danger",
						header: "Ошибка"
					});
				}
			});
		}
	});
});

// $('.keywords').chosen({
// 	create_option: true,
// 	// persistent_create_option decides if you can add any term, even if part
// 	// of the term is also found, or only unique, not overlapping terms
// 	persistent_create_option: true,
// 	// with the skip_no_results option you can disable the 'No results match..'
// 	// message, which is somewhat redundant when option adding is enabled
// 	skip_no_results: true,
// 	create_option_text: 'Добавить'
// });

$(function(){
	// $(".left-sidebar").navobile({
	//   cta: "#show-sidebar",
	//   changeDOM: true,
	// });
	$('[data-toggle="tooltip"]').tooltip();
	$('#content').click(function() {
		if($("#navobile-undefined").hasClass('navobile-navigation-visible'))
			$( "#show-sidebar" ).trigger( "click" );
	});
	$('#show-sidebar').click(function(){
		if($("#navobile-undefined").hasClass('navobile-navigation-visible')){
			$('#show-sidebar').removeClass('animated slideInLeftSmall');
			$('#show-sidebar i').removeClass('fa-bars');	
			$('#show-sidebar i').addClass('fa-times');	
			$('#show-sidebar').addClass('active');	
			$('#show-sidebar').addClass('animated rotateIn');

		}
		else{

			$('#show-sidebar').addClass('animated slideInLeftSmall');
			$('#show-sidebar i').addClass('fa-bars');	
			$('#show-sidebar i').removeClass('fa-times');	
			$('#show-sidebar').removeClass('active');
			$('#show-sidebar').removeClass('animated rotateIn');

		}
	});
	$('a.has-dropdown').click(function(e){
		e.preventDefault();
		$(this).next('ul.hidden-dropdown').slideToggle();
		if($(this).hasClass('dropped')){
			$(this).removeClass('dropped');
		}
		else{
			$(this).addClass('dropped');
		}
	});
	$('.left-sidebar ul.hidden-dropdown li.active').parent().prev().addClass('dropped');
});