@extends('admin.index')
@section('content')

<main>
	<div class="page-header">
		<h1><a href="/index.html" class="back"><i class="fa fa-chevron-circle-left"></i></a>Inputs</h1>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-md-6">
				<div>
					<label for="single">Single</label>
					<select name="" id="single" class="chosen width-100">
						<option value="html">HTML</option>
						<option value="jquery">JQuery</option>
						<option value="css">CSS</option>
						<option value="php">PHP</option>
						<option value="laravel">Laravel</option>
					</select>
				</div>

				<div>
					<label for="multiselect">Multiselect</label>
					<select name="" id="multiselect" class="chosen width-100" multiple>
						<option value="html">HTML</option>
						<option value="jquery">JQuery</option>
						<option value="css">CSS</option>
						<option value="php">PHP</option>
						<option value="laravel">Laravel</option>
					</select>
				</div>
				<div>
					<label for="optgroup">Optgroup</label>
					<select name="" id="optgroup" class="chosen width-100" multiple>
						<optgroup label="Language">
							<option value="html">HTML</option>
							<option value="jquery">JQuery</option>
							<option value="css">CSS</option>
							<option value="php">PHP</option>
							<option value="laravel">Laravel</option>
						</optgroup>
						<optgroup label="Something else">
							<option value="html">HTML</option>
							<option value="jquery">JQuery</option>
							<option value="css">CSS</option>
							<option value="php">PHP</option>
							<option value="laravel">Laravel</option>
						</optgroup>
					</select>
				</div>
				
			</div>
		</div>
	</div>
</main>
<script>
	$(function(){
		$('.chosen').chosen();
	});
</script>
@endsection