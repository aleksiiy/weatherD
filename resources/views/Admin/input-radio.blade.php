@extends('admin.index')
@section('content')

<main>
	<div class="page-header">
		<h1><a href="/index.html" class="back"><i class="fa fa-chevron-circle-left"></i></a>Inputs</h1>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="radio radio">
  					<input id="default" type="radio" checked><label for="default">radio default</label>
				</div>
				<div class="radio radio-brand">
  					<input id="brand" type="radio" checked><label for="brand">radio brand</label>
				</div>
				<div class="radio radio-primary">
  					<input id="primary" type="radio" checked><label for="primary">radio primary</label>
				</div>
				<div class="radio radio-danger">
  					<input id="danger" type="radio" checked><label for="danger">radio danger</label>
				</div>
				<div class="radio radio-success">
  					<input id="success" type="radio" checked><label for="success">radio success</label>
				</div>
				<div class="radio radio-warning">
  					<input id="warning" type="radio" checked><label for="warning">radio warning</label>
				</div>
				<div class="radio radio-info">
  					<input id="info" type="radio" checked><label for="info">radio info</label>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection