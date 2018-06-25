$(function() {
  $(document).on('click'.'#dataConfirmOK',function(e){
    e.preventDefault();
    $('#dataConfirmModel').modal('hide');
    $.ajax($(this).attr("href"),{success:MyCallbackFunction})
	$('a[data-confirm]').click(function(ev) {
		var href = $(this).attr('href');
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal"><div class="modal-background"></div><div class="modal-card"><header class="modal-card-head"><p id="dataConfirmLabel" class="modal-card-title">Confirmation de suppression</p><button type="button" class="delete" aria-label="close"></button></header><section class="modal-card-body"></section><footer class="modal-card-foot"><button id="dataConfirmOK" class="button is-success">Effacer</button><button class="button>Annulé</button></footer></div></div>"');
		}
		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
		$('#dataConfirmOK').attr('href', href);
		$('#dataConfirmModal').modal({show:true});

		return false;

	});
});
