@extends('layouts.admin')
@section('title', 'Rumah Sakit')

@section('contentCss')
@include('admin.location.styles.master')
@endsection

@section('contentJs')
@include('admin.location.scripts.master')
@endsection

@section('content')
<div class="row">
	<div class="row col-md-12">
		<div class="col-md-3">
			<button id="btnAdd" class="btn btn-default">Tambah Lokasi RS</button>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<form class="row col-md-12" method="get" action="{{ url()->current() }}">
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
	</form>
	<div class="col-md-12">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Provinsi</th>
					<th>Rumah Sakit ID</th>
					<th>Description ID</th>
					<th>Rumah Sakit EN</th>
					<th>Description EN</th>
					<th>Rumah Sakit CN</th>
					<th>Description CN</th>
					<th>Website</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($hospitals as $hospital)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $hospital->prov_name }}</td>
					<td>{{ $hospital->rumah_sakit_id }}</td>
					<td>{{ $hospital->description_id }}</td>
					<td>{{ $hospital->rumah_sakit_en }}</td>
					<td>{{ $hospital->description_en }}</td>
					<td>{{ $hospital->rumah_sakit_cn }}</td>
					<td>{{ $hospital->description_cn }}</td>
					<td>{{ $hospital->website }}</td>
					<td>
						<form action="{{ route('location.delete', $hospital->rs_id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger btn-delete">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $hospitals->links() }}
	</div>
</div>

<div id="dlgData" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Rumah Sakit</h4>
			</div>
			<form class="form-horizontal" id="frmData" onSubmit="return false" method="post" enctype="multipart/form-data" action="#">
				<div class="modal-body">
					<div id="alertData" style="display: none;"></div>
					@csrf
					<input type="hidden" name="mode" value="add" id="mode">
					<input type="hidden" name="token" value="token" id="token">
					<!-- Tabs navs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item active">
							<a class="nav-link active" href="#indonesia" role="tab" data-toggle="tab">Indonesia</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#english" role="tab" data-toggle="tab">English</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#china" role="tab" data-toggle="tab">China</a>
						</li>
					</ul>
					<br>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="indonesia">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="rumah_sakit">Rumah Sakit</label>
								<div class="col-sm-9">
									<input name="rumah_sakit_id" id="rumah_sakit_id" type="text" class="form-control" maxlength="255" autofocus="autofocus" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="description">Description</label>
								<div class="col-sm-9">
									<textarea name="description_id" id="description_id" class="form-control" required>
									</textarea>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="english">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="rumah_sakit">Rumah Sakit English</label>
								<div class="col-sm-9">
									<input name="rumah_sakit_en" id="rumah_sakit_en" type="text" class="form-control" maxlength="255" autofocus="autofocus" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="description">Description English</label>
								<div class="col-sm-9">
									<textarea name="description_en" id="description_en" class="form-control" required>
									</textarea>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="china">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="rumah_sakit">Rumah Sakit China</label>
								<div class="col-sm-9">
									<input name="rumah_sakit_cn" id="rumah_sakit_cn" type="text" class="form-control" maxlength="255" autofocus="autofocus" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="description">Description China</label>
								<div class="col-sm-9">
									<textarea name="description_cn" id="description_cn" class="form-control" required>
									</textarea>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="website">Website</label>
						<div class="col-sm-9">
							<input name="website" id="website" type="text" class="form-control" maxlength="255" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="provinsi">Provinsi</label>
						<div class="col-sm-9">
							<select name="provinsi" id="provinsi" class="select2">
								<option value="" disabled="disabled" selected="true">Provinsi</option>
								@foreach ($provinces as $id => $province)
								<option value="{{ $province->id }}">{{ $province->name }}</option>
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