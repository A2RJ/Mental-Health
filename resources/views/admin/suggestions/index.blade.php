@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

    <div style="display: flex; gap:10px;">
        <button type="button" style="margin-bottom: 20px;" class="btn btn-default" data-toggle="modal"
            data-target="#modal-default">
            Add Suggestion
        </button>

        <a href="{{ route('suggestion.import') }}" onclick="return confirm('Are you sure you want to import suggestions?')"
            <button type="button" style="margin-bottom: 20px;" class="btn btn-default">
            Import Default Suggestions
            </button>
        </a>

        <form action="{{ route('suggestion.drop') }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete all suggestions?')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete All</button>
        </form>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('suggestion.store') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    <div class="modal-body">
                        <h4 style="margin-bottom: 10px;">Add new suggestion</h4>
                        <div>
                            <label for="locale">Locale</label>
                            <select name="locale" id="locale" class="form-control" required>
                                <option value="">-- Select --</option>
                                <option value="id">Indonesia</option>
                                <option value="en">English</option>
                                <option value="cn">Chinese</option>
                            </select>
                        </div>
                        <div>
                            <label for="title">Suggestion title</label>
                            <input type="text" name="title" class="form-control" placeholder="" id="title" required
                                autocomplete="off">
                        </div>
                        <div>
                            <label for="description">Suggestion description</label>
                            <textarea name="description" class="form-control" placeholder="" id="description" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn submit btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible" style="padding: 10px;">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <div style="margin-bottom: 20px;">
        <div class="row">
            <div class="col-sm-12">
                <label for="localeFilter">Select suggestion locale</label>
                <select name="localeFilter" id="localeFilter" class="form-control" onchange="changeLocale()">
                    <option value="">-- Select --</option>
                    <option value="id">Indonesia</option>
                    <option value="en">English</option>
                    <option value="cn">Chinese</option>
                </select>
            </div>
        </div>
    </div>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Locale</th>
                <th>Suggestion title</th>
                <th>Suggestion description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suggestions as $key => $suggestion)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $suggestion->locale }}</td>
                    <td>{{ $suggestion->title }}</td>
                    <td>{{ $suggestion->description }}</td>
                    <td>
                        <form action="{{ route('suggestion.destroy', $suggestion->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                        </form>
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

        function changeLocale() {
            var locale = $('#localeFilter').val();
            if (locale) {
                window.location.href = "{{ route('suggestion.index') }}?locale=" + locale;
            } else {
                window.location.href = "{{ route('suggestion.index') }}";
            }
        }
    </script>
@endsection
