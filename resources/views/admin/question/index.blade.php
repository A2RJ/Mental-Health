@extends('layouts.admin')
@section('title', 'Questions list')

@section('content')
    <form class="contact-form" method="POST" onsubmit="return false">
        @csrf
        <input type="hidden" name="category_id" id="category_id" value="{{ $question }}">

        <div class="modal-footer d-flex justify-content-between form-navigation">
            <button type="button" class="m-3 btn shadow btn-primary" onclick="createForm()">Add question</button>
            <button type="submit" id="submit-question" class="m-3 btn shadow btn-primary" onclick="submitForm()">Submit</button>
        </div>
    </form>

    {{-- if error --}}
    @if ($errors->any())
        <div class="alert alert-danger" style="padding: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- if success --}}
    @if (session('success'))
        <div class="alert alert-success" style="padding: 10px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- if error --}}
    @if (session('error'))
        <div class="alert alert-danger" style="padding: 10px;">
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
                    <h4>Edit Question</h4>
                </div>
                <form method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="category_id" id="category_id" value="{{ $question }}">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="locale">Location</label>
                            <input type="text" class="form-control" id="locale" name="locale" value="" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="question">Question</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." id="question" name="question" required></textarea>
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
                            <button style="margin-bottom: 10px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"
                                onclick="editModal({{ $question }})">
                                Edit
                            </button> <br>
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
    </div>

    <script src="{{ asset('bootstrap5/js/datatable-jquery-3.5.1.js') }}"></script>
    <script>
        function localeChange() {
            const locale = $('#select-locale').val();
            const url = $('#select-locale').closest('form').attr('action');
            window.location.href = `${url}?select-locale=${locale}`;
        }

        function editModal(question) {
            const url = "{{ route('question.update', ':id') }}";
            $('#modal-default').find('form').attr('action', url.replace(':id', question.id));
            const answer_options = JSON.parse(question.answer_options);
            $('#id').val(question.id);
            $('#locale').val(question.code);
            $('#question').val(question.question);
        }

        // form add question
        function formSection(index) {
            return `
                <div class="form-section" id="form-section-${index}">
                    <div class="form-group">
                        <label for="locale-${index}">Language <span class="question-title"></span></label>
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
                $('#submit-question').attr('disabled', true)
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
                        // disable button
                        $('#submit-question').attr('disabled', false)
                        $('.form-section').remove()
                    },
                    error: function(data) {
                        $('#submit-question').attr('disabled', false)
                        alert('Something went wrong')
                    }
                })
            } else {
                alert('Please fill all fields')
            }
        }

        function loadDataToTable() {
            // let id = $('#category_id').val()
            // $.ajax({
            //     url: "{{ route('getquestion', ':id') }}".replace(':id', id),
            //     type: 'GET',
            //     success: function(data) {
            //         $('#example').DataTable().clear().draw()
            //         $('#example').DataTable().rows.add(data).draw()
            //     },
            //     error: function(data) {
            //         console.log(data, "error from ajax");
            //     }
            // })
        }
    </script>
@endsection
