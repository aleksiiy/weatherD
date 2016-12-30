@extends('admin.index')
@section('content')

<main>
	<div class="page-header">
		<h1><a href="/index.html" class="back"><i class="fa fa-chevron-circle-left"></i></a>Inputs</h1>
	</div>
	<div class="content">
		<div class="row mb20">
			<div class="col-md-6">
				<input class="form-control mb20" type="text" placeholder="Input">
				<input class="form-control mb20" type="password" placeholder="Password">
				<div class="mb20"><input class="form-control filestyle" type="file" data-placeholder="No file" data-buttonName="btn-brand"></div>
				<div class="form-group">
				    <label for="input">Name</label>
				    <input type="text" class="form-control" id="input" placeholder="Input">
				</div>
				<textarea class="form-control"></textarea>
			</div>
			<div class="col-md-6">
				<input class="form-control mb20 brand" type="text" placeholder="Input">
				<input class="form-control mb20 primary" type="text" placeholder="Input">
				<input class="form-control mb20 danger" type="text" placeholder="Input">
				<input class="form-control mb20 success" type="text" placeholder="Input">
				<input class="form-control mb20 warning" type="text" placeholder="Input">
				<input class="form-control mb20 info" type="text" placeholder="Input">
			</div>
		</div>
		<div class="row mb20">
			<div class="col-md-6">
				<div class="input-group mb20">
				  <span class="input-group-addon" id="addon">@</span>
				  <input type="text" class="form-control" placeholder="Username" aria-describedby="addon">
				</div>
				<div class="input-group mb20">
				  <span class="input-group-addon brand" id="addon"><i class="fa fa-commenting"></i></span>
				  <input type="text" class="form-control brand" placeholder="Username" aria-describedby="addon">
				</div>
				<div class="input-group mb20">
				  <span class="input-group-addon danger" id="addon"><i class="fa fa-commenting"></i></span>
				  <input type="text" class="form-control danger" placeholder="Username" aria-describedby="addon">
				</div>
				<div class="input-group mb20">
				  <span class="input-group-addon success" id="addon"><i class="fa fa-commenting"></i></span>
				  <input type="text" class="form-control success" placeholder="Username" aria-describedby="addon">
				</div>
				<div class="input-group mb20">
				  <span class="input-group-addon primary" id="addon"><i class="fa fa-commenting"></i></span>
				  <input type="text" class="form-control primary" placeholder="Username" aria-describedby="addon">
				</div>
				<div class="input-group mb20">
				  <span class="input-group-addon warning" id="addon"><i class="fa fa-commenting"></i></span>
				  <input type="text" class="form-control warning" placeholder="Username" aria-describedby="addon">
				</div>
				<div class="input-group mb20">
				  <span class="input-group-addon info" id="addon"><i class="fa fa-commenting"></i></span>
				  <input type="text" class="form-control info" placeholder="Username" aria-describedby="addon">
				</div>
			</div>
		</div>
	</div>
</main>

@endsection