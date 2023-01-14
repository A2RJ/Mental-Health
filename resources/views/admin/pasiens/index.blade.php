@extends('layouts.admin')
@section('title', 'Provinsi')

@section('contentCss')
<style>
    div.dt-buttons {
        position: relative;
        float: right;
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
            url: "{{ route('pasiens.json') }}",
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
            },
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d.keyword = $('#keyword').val();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (errorThrown == 'Unauthorized') {
                    alert('Session Expired!');
                    location.reload();
                }
            }
        },
        order: [
            [1, "asc"]
        ],
        fnServerParams: function(data) {
            data['order'].forEach(function(items, index) {
                data['order'][index]['column'] = data['columns'][items.column]['data'];
            });
        },
        columns: [{
                data: "pasien_id",
                name: "pasien_id",
                orderable: false,
                render: function(data, type, row, meta) {
                    return (meta.row + 1);
                }
            },
            {
                data: "name",
                name: "name"
            },
            {
                data: "age",
                name: "age"
            },
            {
                data: "occupation",
                name: "occupation"
            },
            {
                data: "location",
                name: "location"
            },
            {
                data: "category",
                name: "category"
            },
            {
                data: "score",
                name: "score"
            },
            {
                data: "result",
                name: "result"
            },
            {
                data: "pasien_id",
                name: "pasien_id",
                orderable: false,
                render: function(data, type, row, meta) {
                    var elShow = '<a class="btn btn-sm btn-default" href="javascript: editData(\'' + row
                        .name + '\',\'' + row.pasien_id + '\');"><i class="fa fa-eye"></i></a>';
                    return '<div class="btn-group">\
            								' + elShow + '\
            							</div>';
                }
            },
        ],
        columnDefs: [{
            targets: [0, 1, 2, 3, 4, 5, 6, 7],
            className: 'text-left',
        }],
        lengthChange: true,
        pagingType: 'numbers',
        pageLength: 25,
        aLengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        dom: 'lrti',
    });

    function editData(edit, token) {
        postData = new Object();
        postData.token = token;
        ajax({
            url: "{{ route('pasiens.show') }}",
            postData: postData,
            success: function(ret) {
                console.log(ret);
                $('#dlgData').modal('show');
                var data = ret.data;

                $('#mode').val("edit");
                $('#token').val(data.rs_id);
                $('#name').val(data.name);
                $('#age').val(data.age);
                $('#occupation').val(data.occupation);
                $('#location').val(data.location);
                $('#score').val(data.score);
                $('#result').val(data.result);
                $('#category').val(data.category);
            }
        });
    }

    $('#filter').click(function(e) {
        table.draw();
    });
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('pasiens.export') }}">
            <button class="btn btn-primary" style="margin-bottom: 20px;">Export</button>
        </a>
    </div>
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
                    <th>Name</th>
                    <th>Age</th>
                    <th>Lang</th>
                    <th>Occupation</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Score</th>
                    <th>Result</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pasiens as $pasien)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pasien->name }}</td>
                    <td>{{ $pasien->age }}</td>
                    <td>{{ $pasien && $pasien->test ? json_decode($pasien->test)->locale : '' }}</td>
                    <td>{{ $pasien->occupation }}</td>
                    <td>{{ $pasien->location }}</td>
                    <td>{{ $pasien->category }}</td>
                    <td>{{ $pasien->score }}</td>
                    <td>{{ $pasien->result }}</td>
                    <td>
                        <form action="{{ route('pasiens.delete', $pasien->pasien_id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pasiens->links() }}
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
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="prov_name">Name</label>
                        <div class="col-sm-9">
                            <input name="prov_name" id="name" type="text" class="form-control" maxlength="255" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="prov_name">Age</label>
                        <div class="col-sm-9">
                            <input name="prov_name" id="age" type="text" class="form-control" maxlength="255" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="prov_name">Occupation</label>
                        <div class="col-sm-9">
                            <input name="prov_name" id="occupation" type="text" class="form-control" maxlength="255" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="prov_name">Location</label>
                        <div class="col-sm-9">
                            <input name="prov_name" id="location" type="text" class="form-control" maxlength="255" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="prov_name">Category</label>
                        <div class="col-sm-9">
                            <input name="prov_name" id="category" type="text" class="form-control" maxlength="255" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="prov_name">Score</label>
                        <div class="col-sm-9">
                            <input name="prov_name" id="score" type="text" class="form-control" maxlength="255" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="prov_name">Result</label>
                        <div class="col-sm-9">
                            <input name="prov_name" id="result" type="text" class="form-control" maxlength="255" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection