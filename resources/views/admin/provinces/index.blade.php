@extends('layouts.admin')
@section('title', 'Provinsi')

@section('contentCss')
	@include('admin.provinces.styles.master')
@endsection

@section('contentJs')
	@include('admin.provinces.scripts.master')
@endsection

@section('content')
<div class="row">
	<div class="row col-md-12">
		<div class="col-md-3">
			<button id="btnAdd" class="btn btn-default">Tambah Provinsi</button>
		</div>
	</div>
	<br><br>
	<div class="row col-md-12">
		<div class="col-md-10">
			<div class="form-group has-feedback">
				<input type="text" name="keyword" class="form-control" placeholder="Keyword" id="keyword" autocomplete="off">
				<span class="fa fa-search form-control-feedback"></span>
			</div>
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-primary btn-block" id="filter" style="width: 100%">
				<span class="fa fa-filter"> Filter</span>
			</button>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<table id="grdData" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th style=" ">No</th>
					<th style=" ">Provinsi</th>
					<th style=" ">Negara</th>
					<th style=" ">Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<div id="dlgData" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Provinsi</h4>
			</div>
			<form class="form-horizontal" id="frmData" onSubmit="return false" method="post" enctype="multipart/form-data" action="#">
				<div class="modal-body">
					<div id="alertData" style="display: none;"></div>
					@csrf
					<input type="hidden" name="mode" value="add" id="mode">
					<input type="hidden" name="token" value="token" id="token">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="prov_name">Provinsi</label>
						<div class="col-sm-9">
							<input name="prov_name" id="prov_name" type="text" class="form-control" maxlength="255" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="country_id">Negara</label>
						<div class="col-sm-9">
							<select name="country_id" id="country_id" class="select2">
								<option value="" disabled="disabled" selected="true">Negara</option>
								@foreach ($countries as $id => $country)
									<option value="{{ $country->id }}">{{ $country->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default" id="save">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection