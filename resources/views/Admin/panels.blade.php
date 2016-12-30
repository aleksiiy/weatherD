@extends('admin.index')

@section('content')
<main>
	<div class="page-header">
		<h1><a href="/index.html" class="back"><i class="fa fa-chevron-circle-left"></i></a>Panels</h1>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-heading"><h3 class="panel-title">Panel title</h3></div>
				  <div class="panel-body">
				    Panel content
				  </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
				  <div class="panel-heading"><h3 class="panel-title">Panel title</h3></div>
				  <div class="panel-body">
				    Panel content
				  </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-danger">
				  <div class="panel-heading"><h3 class="panel-title">Panel title</h3></div>
				  <div class="panel-body">
				    Panel content
				  </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-success">
				  <div class="panel-heading"><h3 class="panel-title">Panel title</h3></div>
				  <div class="panel-body">
				    Panel content
				  </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-warning">
				  <div class="panel-heading"><h3 class="panel-title">Panel title</h3></div>
				  <div class="panel-body">
				    Panel content
				  </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-info">
				  <div class="panel-heading"><h3 class="panel-title">Panel title</h3></div>
				  <div class="panel-body">
				    Panel content
				  </div>
				</div>
			</div>
		</div>
		<span class="label label-default">Label</span>
		<span class="label label-primary">Label</span>
		<span class="label label-danger">Label</span>
		<span class="label label-success">Label</span>
		<span class="label label-warning">Label</span>
		<span class="label label-info">Label</span>
	</div>
</main>

@endsection