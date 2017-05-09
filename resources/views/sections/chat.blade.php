@extends('layouts.dashboard')

@section('title', 'Conversación')
@section('content')

    @component('components.chat', ['messages' => $orderedMessages, 'recipient' => $client])
        @slot('route')
            {{ route('message.toClient', [$client->id]) }}
        @endslot
    @endcomponent

@endsection

@push('scripts')
    <script src="{{ mix('/js/chat.js') }}"></script>
@endpush