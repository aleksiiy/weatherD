
<main>
	<div class="page-header">
		<h1><a href="/index.html" class="back"><i class="fa fa-chevron-circle-left"></i></a>Inputs</h1>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="checkbox checkbox">
  					<input id="default" type="checkbox" checked><label for="default">Checkbox default</label>
				</div>
				<div class="checkbox checkbox-brand">
  					<input id="brand" type="checkbox" checked><label for="brand">Checkbox brand</label>
				</div>
				<div class="checkbox checkbox-primary">
  					<input id="primary" type="checkbox" checked><label for="primary">Checkbox primary</label>
				</div>
				<div class="checkbox checkbox-danger">
  					<input id="danger" type="checkbox" checked><label for="danger">Checkbox danger</label>
				</div>
				<div class="checkbox checkbox-success">
  					<input id="success" type="checkbox" checked><label for="success">Checkbox success</label>
				</div>
				<div class="checkbox checkbox-warning">
  					<input id="warning" type="checkbox" checked><label for="warning">Checkbox warning</label>
				</div>
				<div class="checkbox checkbox-info">
  					<input id="info" type="checkbox" checked><label for="info">Checkbox info</label>
				</div>

				<input type="checkbox" class="switch" id="switchery" checked />
			</div>

		</div>
		<ul class="pagination">
			<li><a href="#">‹</a></li>
			<li class="active"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li class="disabled"><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">›</a></li>
		</ul>
	</div>
</main>

<script>
	$(function(){
		var sw = document.querySelector('.switch');
		var switchery = new Switchery(sw, {
			size: 'small'
		});
	});
</script>
@endsection