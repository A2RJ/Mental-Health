<script>

	var token = '';

	table = $('#grdData').DataTable({
		processing: true,
		serverSide: true,
		ordering: true,
		info: true,
		responsive: true,
		ajax: {
			url: "{{ route('countries.json') }}",
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
			{ data: "country_id", name: "country_id", orderable: false,
				render: function(data, type, row, meta){
					return (meta.row+1);
				}
			},
			{ data: "country_name", name: "country_name" },
			{ data: "country_id", name: "country_id", orderable: false, 
				render: function(data, type, row, meta){
					var elShow = '<a class="btn btn-sm btn-default" href="javascript: editData(\''+row.country_name+'\',\''+row.country_id+'\');"><i class="fa fa-eye"></i></a>';
					return '<div class="btn-group">\
							'+elShow+'\
						</div>';
				} 			
			},
		],
		columnDefs: [
			{
				targets: [0,1,2], 
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

		$('#dlgData').modal('show');
		mode = 'add';
	});

    $('#frmData').submit(function(){
		var formData = new FormData($('#frmData')[0]);
		$.ajax({
			type: 'POST',
			headers: {'X-CSRF-TOKEN': csrfToken},
            data: formData,
			url : "{{ route('countries.save') }}", 
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

	function editData(edit, token){
		postData = new Object();
		postData.token = token;
		ajax({
			url : "{{ route('countries.show') }}", 
			postData : postData,
			success : function(ret){
				console.log(ret);
				$('#dlgData').modal('show');
				var data = ret.data;

				$('#mode').val("edit");
				$('#token').val(data.country_id);
				$('#country_name').val(data.country_name);
			}
		});
	}

    $('#filter').click(function(e){
		table.draw();
	});

</script>