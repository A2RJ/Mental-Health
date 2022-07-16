@extends('layouts.admin')
@section('title', 'Questions')

@section('content')
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
                <form action="{{ route('question-category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="title">Question name</label>
                        <input type="text" name="name" class="form-control" placeholder="" id="name" required
                            autocomplete="off">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn submit btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label for="title">Question name</label>
                        <input type="text" name="name" class="form-control" placeholder="" id="name" required
                            autocomplete="off">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn submit btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    {{-- show success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- show error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Question name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $key => $question)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $question->name }}</td>
                    <td>
                        <a href="{{ route('question.index', $question->id) }}" class="btn btn-info btn-sm">
                            Detail
                        </a>
                        <button type="button" onclick="addValueToModal({{ $question->id }}, '{{ $question->name }}')"
                            class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit">
                            Edit
                        </button>
                        {{-- <form action="{{ route('question.destroy', $question->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form> --}}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="{{ asset('bootstrap5/js/datatable-jquery-3.5.1.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function addValueToModal(id, name) {
            $('#modal-edit form').attr('action', '{{ route('question-category.update', 'id') }}'.replace('id', id));
            $('#modal-edit').find('input[name="name"]').val(name);
        }
    </script>
@endsection
