@extends('layouts.admin')
@section('title', 'Add new questions')

@section('content')
    <form class="contact-form" method="POST" onsubmit="return false">
        @csrf
        <input type="hidden" name="category_id" id="category_id" value="{{ $question }}">

        <div class="modal-footer d-flex justify-content-between form-navigation">
            <button type="button" class="m-3 btn shadow btn-primary" onclick="createForm()">Add question</button>
            <button type="submit" class="m-3 btn shadow btn-primary" onclick="submitForm()">Submit</button>
        </div>
    </form>

    <script>
        function formSection(index) {
            return `
                <div class="form-section" id="form-section-${index}">
                    <h3 class="text-center question-title">Select language</h3>
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
                    <div class="form-group">
                        <label for="answer-${index}">Option A</label>
                        <textarea class="form-control" id="answer-${index}" name="answer-a" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer-${index}">Option B</label>
                        <textarea class="form-control" id="answer-${index}" name="answer-b" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer-${index}">Option C</label>
                        <textarea class="form-control" id="answer-${index}" name="answer-c" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer-${index}">Option D</label>
                        <textarea class="form-control" id="answer-${index}" name="answer-d" rows="2" required></textarea>
                    </div>

                    <button type="button" class="btn btn-danger float-right" onclick="deleteFormSection(${index})">Delete</button>
                </div>

            `
        }

        // loop and check if select has changed then changed .question-title
        function changeQuestionTitle(index) {
            let code = $('#locale-' + index).val()
            let title = $(`#locale-${index} option[value="${code}"]`).text()
            $('#form-section-' + index + ' .question-title').text(code + ' - ' + title)
        }

        function validateForm() {
            let valid = true
            $('.form-section').each(function () {
                let count = $(this).find('select, textarea').length
                let countValid = 0
                $(this).find('select, textarea').each(function () {
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
                validateForm()
                    ? $('.form-section').last().after(formSection(formLength + 1))
                    : alert('Please fill all fields')
            }
        }

        function deleteFormSection(index) {
            $(`#form-section-${index}`).remove()
        }

        function submitForm() {
            if (validateForm()) {
                let formData = []
                $('.form-section').each(function () {
                    let locale = $(this).find('select').val()
                    let question = $(this).find('textarea[name^="question"]').val()
                    let answerA = $(this).find('textarea[name^="answer-a"]').val()
                    let answerB = $(this).find('textarea[name^="answer-b"]').val()
                    let answerC = $(this).find('textarea[name^="answer-c"]').val()
                    let answerD = $(this).find('textarea[name^="answer-d"]').val()

                    formData.push({
                        locale: locale,
                        question: question,
                        answer_a: answerA,
                        answer_b: answerB,
                        answer_c: answerC,
                        answer_d: answerD
                    })
                })

                // send to server
                $.ajax({
                    url: '{{ route('question.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        category_id: $('#category_id').val(),
                        data: formData
                    },
                    success: function (data) {
                        alert('Successfully added')
                        window.location.href = '{{ route('question.index', $question) }}'
                    },
                    error: function (data) {
                        alert('Something went wrong')
                    }
                })
            } else {
                alert('Please fill all fields')
            }
        }
    </script>
@endsection
