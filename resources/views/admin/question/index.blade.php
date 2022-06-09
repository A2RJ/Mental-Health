@extends('layouts.admin')
@section('title', 'Questions list')

@section('content')
    <style>
        .btn-add {
            margin-bottom: 20px;
        }

    </style>

{{-- <a href="{{ route('question.create', $question) }}" class="btn btn-primary btn-add">Add new question</a> --}}

    {{-- <button type="button" onclick="addRoute()" class="btn btn-default btn-add" data-toggle="modal"
        data-target="#modal-default">
        Add Question
    </button> --}}
    <form class="contact-form" method="POST" onsubmit="return false">
        @csrf
        <input type="hidden" name="category_id" id="category_id" value="{{ $question }}">

        <div class="modal-footer d-flex justify-content-between form-navigation">
            <button type="button" class="m-3 btn shadow btn-primary" onclick="createForm()">Add question</button>
            <button type="submit" class="m-3 btn shadow btn-primary" onclick="submitForm()">Submit</button>
        </div>
    </form>

    {{-- if error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- if success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- if error --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4>Add Question</h4>
                </div>
                <form method="POST">
                    @csrf
                    <input type="hidden" name="category_id" id="category_id" value="{{ $question }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="locale">Location</label>
                            <select class="form-control" id="locale" name="locale" required>
                                <option value="">Select Location</option>
                                @foreach ($locales as $locale)
                                    <option value="{{ $locale['code'] }}">{{ $locale['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="question">Question</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." id="question" name="question" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="option_1">Option 1</label>
                            <textarea class="form-control" rows="2" placeholder="Enter ..." id="option_1" name="answer_options[]"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="option_2">Option 2</label>
                            <textarea class="form-control" rows="2" placeholder="Enter ..." id="option_2" name="answer_options[]"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="option_3">Option 3</label>
                            <textarea class="form-control" rows="2" placeholder="Enter ..." id="option_3" name="answer_options[]"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="option_4">Option 4</label>
                            <textarea class="form-control" rows="2" placeholder="Enter ..." id="option_4" name="answer_options[]"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn submit btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="contaainer">
        {{-- create form to send params query locale --}}
        <form method="GET" action="{{ route('question.index', $question) }}">
            <div class="form-group">
                <label for="select-locale">Location</label>
                <select class="form-control" id="select-locale" name="select-locale" required onchange="localeChange()">
                    <option value="">Select Location</option>
                    @foreach ($locales as $locale)
                        <option value="{{ $locale['code'] }}">{{ $locale['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Locale</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $question->code }}</td>
                        <td>{{ $question->question }}</td>
                        <td>
                            <ul>
                                @foreach ($question->getAnswerOptions() as $answer_option)
                                    <li>{{ $answer_option }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{-- edit model --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"
                                onclick="editModal({{ $question }})">
                                Edit
                            </button>
                            <form action="{{ route('question.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
<button onclick="loadDataToTable()">HAHAAH</button>
    </div>

    <script src="{{ asset('bootstrap5/js/datatable-jquery-3.5.1.js') }}"></script>
    <script>
        @if ($errors->any())
            $('#modal-default').modal('show');
        @endif

        $(document).ready(function() {
            $('#example').DataTable();
        });

        function editModal(question) {
            const url = "{{ route('question.update', ':id') }}";
            $('#modal-default').find('form').attr('action', url.replace(':id', question.id));
            $('#modal-default').find('form').append(`
                <input type="hidden" name="_method" value="PUT">
            `);

            $('#modal-default').find('select').val(question.locale).attr('disabled', true);

            const answer_options = JSON.parse(question.answer_options);
            $('#question').val(question.question);
            $('#option_1').val(answer_options[0]);
            $('#option_2').val(answer_options[1]);
            $('#option_3').val(answer_options[2]);
            $('#option_4').val(answer_options[3]);
        }

        function addRoute() {
            const url = "{{ route('question.store') }}";
            $('#modal-default form').attr('action', url);
            $('#modal-default form').find('input[name="_method"]').remove();

            $('#modal-default').find('select').val('').attr('disabled', false);
            $('#modal-default').find('textarea').val('');
        }

        function localeChange() {
            const locale = $('#select-locale').val();
            const url = $('#select-locale').closest('form').attr('action');
            window.location.href = `${url}?select-locale=${locale}`;
        }

        // form add question

        function formSection(index) {
            return `
                <div class="form-section" id="form-section-${index}">
                    <p class="text-center question-title">Select language</p>
                    <div class="form-group">
                        <label for="locale-${index}">Language</label>
                        <select class="form-control" id="locale-${index}" name="locale" required onchange="changeQuestionTitle(${index})">
                            <option value="">Select Language</option>
                            @foreach ($locales as $locale)
                                <option value="{{ $locale['code'] }}">{{ $locale['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="question-${index}">Question</label>
                        <textarea class="form-control" id="question-${index}" name="question" rows="2" required></textarea>
                    </div>

                    <button type="button" class="btn btn-danger float-right" onclick="deleteFormSection(${index})">Delete</button>
                </div>
            `
        }

        function changeQuestionTitle(index) {
            let code = $('#locale-' + index).val()
            let title = $(`#locale-${index} option[value="${code}"]`).text()
            $('#form-section-' + index + ' .question-title').text(code + ' - ' + title)
        }

        function validateForm() {
            let valid = true
            $('.form-section').each(function() {
                let count = $(this).find('select, textarea').length
                let countValid = 0
                $(this).find('select, textarea').each(function() {
                    if ($(this).val() != '') {
                        countValid++
                    }
                })
                if (countValid != count) {
                    valid = false
                }
            })

            return valid
        }

        function createForm() {
            let formLength = $('.form-section').length

            if (formLength == 0) {
                $('#category_id').after(formSection(1))
            } else {
                validateForm() ?
                    $('.form-section').last().after(formSection(formLength + 1)) :
                    alert('Please fill all fields')
            }
        }

        function deleteFormSection(index) {
            $(`#form-section-${index}`).remove()
        }

        function submitForm() {
            if (validateForm()) {
                let formData = []
                $('.form-section').each(function() {
                    let locale = $(this).find('select').val()
                    let question = $(this).find('textarea[name^="question"]').val()

                    formData.push({
                        locale: locale,
                        question: question
                    })
                })

                $.ajax({
                    url: "{{ route('question.store') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        category_id: $('#category_id').val(),
                        data: formData
                    },
                    success: function(data) {
                        console.log(data);
                        $('.form-section').remove()
                        loadDataToTable()
                    },
                    error: function(data) {
                        // alert('Something went wrong')
                        console.log(data);
                    }
                })
            } else {
                alert('Please fill all fields')
            }
        }

        function loadDataToTable() {
            $.ajax({
                url: '',
                type: 'GET',
                success: function(data) {
                    console.log(data, "from ajax");
                },
                error: function(data) {
                    console.log(data, "error from ajax");
                }
            })
        }
    </script>
@endsection
