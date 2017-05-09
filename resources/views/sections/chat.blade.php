@extends('layouts.dashboard')

@section('title', 'Conversación')
@section('content')

    @component('components.chat', ['messages' => $orderedMessages, 'recipient' => $recipient])
        @slot('route')
            {{ route("message.to{$recipientType}", [$recipient->id]) }}
        @endslot
    @endcomponent

@endsection

@push('scripts')
    <script src="{{ mix('/js/chat.js') }}"></script>
@endpush