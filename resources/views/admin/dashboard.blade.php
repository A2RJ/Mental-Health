@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

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

    <form action="{{ route('admin.social-media') }}" method="post">
        @csrf
        {{-- ig --}}
        <div class="form-group">
            <label for="ig">Instagram link</label>
            <input type="text" class="form-control" id="ig" name="ig" value="{{ $contact['ig'] }}">
        </div>
        {{-- wa --}}
        <div class="form-group">
            <label for="wa">Whatsapp</label>
            <input type="number" class="form-control" id="wa" name="wa" value="{{ $contact['wa'] }}">
        </div>
        {{-- wa subject --}}
        <div class="form-group">
            <label for="wa_subject">Whatsapp Subject</label>
            <textarea class="form-control" id="wa_subject" name="wa_subject" rows="3">{{ $contact['wa_subject'] }}</textarea>
        </div>
        {{-- email --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $contact['email'] }}">
        </div>
        {{-- email subject --}}
        <div class="form-group">
            <label for="email_subject">Email Subject</label>
            <textarea class="form-control" id="email_subject" name="email_subject" rows="3">{{ $contact['email_subject'] }}</textarea>
        </div>
        {{-- submit --}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
