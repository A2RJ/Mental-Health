@extends('layouts.admin')
@section('title', 'Questions')

@section('content')
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap5/css/datatables-bootstrap.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap5/css/dataTables.bootstrap5.min.css') }}"> --}}
    <script src="{{ asset('bootstrap5/js/datatable-jquery-3.5.1.js') }}"></script>
    {{-- <script src="{{ asset('bootstrap5/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bootstrap5/js/dataTables.bootstrap5.min.js') }}"></script> --}}

    <style>
        .btn-add {
            margin-bottom: 20px;
        }

    </style>

    <button type="button" class="btn btn-default btn-add" data-toggle="modal" data-target="#modal-default">
        Add Question
    </button>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('question.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="title">Question name</label>
                        <input type="text" name="keyword" class="form-control" placeholder="" id="title" name="title"
                            required autocomplete="off">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn submit btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011-07-25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012-03-29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008-11-28</td>
                <td>$162,700</td>
            </tr>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        // prevent form submit
        $('.submit').click(function(e) {
            // submit data to controller using ajax wth method post and csrf

            // $.ajax({
            //     url: "{{ route('question.store') }}",
            //     type: 'POST',
            //     data: {
            //         title: $('#title').val(),
            //         _token: "{{ csrf_token() }}"
            //     },
            //     success: function(data) {
            //         // close modal
            //         $('#modal-default').modal('hide');
            //         // reload page
            //         // location.reload();
            //         console.log(data);
            //     },
            //     error: function(data) {
            //         console.log(data);
            //     }
            // });
        });
    </script>
@endsection
