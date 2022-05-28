@extends('layouts.admin')
@section('title', 'Admin Desa')
@section('contentCss')
<style>
div.dt-buttons{
	position:relative;
	float:right;
	margin-bottom: 10px;
}
</style>
@endsection
@section('contentJs')
<script>

	var token = '';

	table = $('#grdData').DataTable({
		processing: true,
		serverSide: true,
		ordering: true,
		info: true,
		responsive: true,
		ajax: {
			url: "{{ route('location.json') }}",
			beforeSend	: function(xhr){ 
				xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
			},
			type: 'POST',
			dataType : 'json',
			data: function(d) {
				d.keyword = $('#keyword').val();
			},
			error: function (jqXHR, textStatus, errorThrown) {
                if (errorThrown == 'Unauthorized') {
                	alert('Session Expired!');
                	location.reload();
                }
            }
		},
		order: [[ 1, "asc" ]],
		fnServerParams: function(data) {
		  data['order'].forEach(function(items, index) {
			  data['order'][index]['column'] = data['columns'][items.column]['data'];
			});
		},
		columns: [
			{ data: "id", name: "id", orderable: false,
				render: function(data, type, row, meta){
					return (meta.row+1);
				}
			},
			{ data: "rumah_sakit", name: "rumah_sakit"},
			{ data: "description", name: "description" },
			{ data: "prov_name", name: "prov_name" },
			{ data: "website", name: "website" },
			{ data: "id", name: "id", orderable: false, 
				render: function(data, type, row, meta){
					var elShow = '<a class="btn btn-sm btn-default" href="javascript: editData(\''+row.rumah_sakit+'\',\''+row.id+'\');"><i class="fa fa-eye"></i></a>';

					var elDelete = '<a class="btn btn-sm btn-default" href="javascript: deleteData(\''+row.id+'\', \''+row.rumah_sakit+'\');"><i class="fa fa-trash"></i></a>';
					return '<div class="btn-group">\
							'+elShow+'\
							'+elDelete+'\
						</div>';
				} 			
			},
		],
		columnDefs: [
			{
				targets: [0,1,2,3], 
				className: 'text-left',
			}
		],
		lengthChange: true,
		pagingType: 'numbers',
		pageLength: 25,
		aLengthMenu: [
	        [10, 25, 50, 100],
	        [10, 25, 50, 100]
	    ],
		dom: 'lrti',
	});
	
    $('#btnAdd').click(function(e){
		alertBox('hide', {selectorAlert: '#alertData'});
		$('.modal-footer').removeAttr('style');
		$('#mode').val("add");
		$('#token').val(token);

		$('input.form-control', '#frmData').val('');
		$('textarea.form-control', '#frmData').val('');
		$('#provinsi').val($("#provinsi option:first").val()).trigger('change');

		$('#dlgData').modal('show');
		mode = 'add';
	});

    $('#frmData').submit(function(){
		var formData = new FormData($('#frmData')[0]);
		$.ajax({
			type: 'POST',
			headers: {'X-CSRF-TOKEN': csrfToken},
            data: formData,
			url : "{{ route('location.save') }}", 
            contentType: false,
            processData: false,   
            cache: false,
			selectorBlock: '#dlgData .modal-content',
			selectorAlert: '#alertData',
			success : function(ret){
				if (ret.result == true) {
					$('#dlgData').modal('hide');
					alertBox('show', {msg: 'Data berhasil disimpan', mode: 'success'});
					table.draw();
				} else {
					alertBox('show', {msg: ret.msg, selectorAlert: '#alertData'});
				}
			},
		});
	});

	function deleteData(token, rumah_sakit){
		conf = confirm("Apakah anda yakin akan menghapus "+rumah_sakit+" ?");
		if( conf ){
			postData = new Object();
			postData.token = token;

			ajax({
				url : "{{ route('location.delete') }}", 
				postData : postData,
				success : function(ret){
					alert("Rumah sakit "+rumah_sakit+" berhasil dihapus");
					table.draw();
				},
			});		
		}
	}

	function editData(edit, token){
		postData = new Object();
		postData.token = token;
		ajax({
			url : "{{ route('location.show') }}", 
			postData : postData,
			success : function(ret){
				console.log(ret);
				$('#dlgData').modal('show');
				var data = ret.data;

				$('#mode').val("edit");
				$('#token').val(data.id);
				$('#rumah_sakit').val(data.rumah_sakit);
				$('#description').val(data.description);
				$('#website').val(data.website);
				$('#provinsi').val(data.province_id).trigger('change');
			}
		});
	}

    $('#filter').click(function(e){
		table.draw();
	});

</script>
@endsection
@section('content')
<div class="row">
	<div class="row col-md-12">
		<div class="col-md-3">
			<button id="btnAdd" class="btn btn-default">Tambah Lokasi RS</button>
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
					<th style=" ">Rumah Sakit</th>
					<th style=" ">Description</th>
					<th style=" ">Provinsi</th>
					<th style=" ">Website</th>
					<th style=" ">Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<div id="dlgData" class="modal fade">
	<div class="modal-dialog">
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
					<div class="form-group">
						<label class="col-sm-3 control-label" for="rumah_sakit">Rumah Sakit</label>
						<div class="col-sm-9">
							<input name="rumah_sakit" id="rumah_sakit" type="text" class="form-control" maxlength="255" autofocus="autofocus" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="description">Description</label>
						<div class="col-sm-9">
							<textarea name="description" id="description" class="form-control" required>
							</textarea>
						</div>
					</div>
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