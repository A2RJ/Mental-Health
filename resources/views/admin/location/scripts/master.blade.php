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
			{ data: "rs_id", name: "rs_id", orderable: false,
				render: function(data, type, row, meta){
					return (meta.row+1);
				}
			},
			{ data: "rumah_sakit_id", name: "rumah_sakit_id" },
			// { data: "description_id", name: "description_id" },
			{ data: "rumah_sakit_en", name: "rumah_sakit_en" },
			// { data: "description_en", name: "description_en" },
			{ data: "rumah_sakit_cn", name: "rumah_sakit_cn" },
			// { data: "description_cn", name: "description_cn" },
			{ data: "prov_name", name: "prov_name" },
			{ data: "website", name: "website" },
			{ data: "rs_id", name: "rs_id", orderable: false, 
				render: function(data, type, row, meta){
					var elShow = '<a class="btn btn-sm btn-default" href="javascript: editData(\''+row.rumah_sakit_id+'\',\''+row.rs_id+'\');"><i class="fa fa-eye"></i></a>';

					var elDelete = '<a class="btn btn-sm btn-default" href="javascript: deleteData(\''+row.rs_id+'\', \''+row.rumah_sakit_id+'\');"><i class="fa fa-trash"></i></a>';
					return '<div class="btn-group">\
							'+elShow+'\
							'+elDelete+'\
						</div>';
				} 			
			},
		],
		columnDefs: [
			{
				targets: [0,1,2,3,4,5,6], 
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
				$('#token').val(data.rs_id);
				$('#rumah_sakit_id').val(data.rumah_sakit_id);
				$('#description_id').val(data.description_id);
				$('#rumah_sakit_en').val(data.rumah_sakit_en);
				$('#description_en').val(data.description_en);
				$('#rumah_sakit_cn').val(data.rumah_sakit_cn);
				$('#description_cn').val(data.description_cn);
				$('#website').val(data.website);
				$('#provinsi').val(data.province_id).trigger('change');
			}
		});
	}

    $('#filter').click(function(e){
		table.draw();
	});

</script>