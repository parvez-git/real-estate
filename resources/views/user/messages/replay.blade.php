@extends('frontend.layouts.app')

@section('styles')
@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col s12 m3">
                    <div class="agent-sidebar">
                        @include('user.sidebar')
                    </div>
                </div>

                <div class="col s12 m9">

                    <h4 class="agent-title">REPLAY MESSAGES</h4>
                    
                    <div class="agent-content">
                        
                        @if($message->user_id)
                            <form action="{{route('user.message.send')}}" method="POST">
                                @csrf
                                <input type="hidden" name="agent_id" value="{{ $message->user_id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">email</i>
                                        <input id="email" type="email" value="{{ $message->email }}" class="validate" readonly>
                                        <label for="email">TO</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="phone" name="phone" type="number" class="validate">
                                        <label for="phone">Phone</label>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">mode_edit</i>
                                        <textarea id="message" name="message" class="materialize-textarea"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <button class="btn waves-effect waves-light btn-small indigo darken-4 right" type="submit">
                                        <span>SEND</span>
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </form>

                        @else
                            <form action="" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">email</i>
                                        <input id="email" name="email" type="email" value="{{ $message->email }}" class="validate" readonly>
                                        <label for="email">TO</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">subject</i>
                                        <input id="subject" name="subject" type="text" class="validate">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">mode_edit</i>
                                        <textarea id="message-mail" name="message" class="materialize-textarea"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <button class="btn waves-effect waves-light btn-small indigo darken-4 right" type="submit">
                                        <span>SEND</span>
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
    
                            </form>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('textarea#message').characterCounter();
        $('textarea#message-mail').characterCounter();
    });
</script>
@endsection