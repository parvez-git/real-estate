@extends('frontend.layouts.app')

@section('styles')
@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col s12 m3">
                    <div class="agent-sidebar">
                        @include('agent.sidebar')
                    </div>
                </div>

                <div class="col s12 m9">

                    <h4 class="agent-title">READ MESSAGES</h4>
                    
                    <div class="agent-content">
                        
                        <span><strong>From:</strong> <em>{{ $message->name }} < {{ $message->email }} ></em></span> <br>
                        <span><strong>Phone:</strong> {{ $message->phone }}</span>

                        <div class="read-message">
                            <span>Message:</span>
                            <p>{!! $message->message !!}</p>
                        </div>

                        <a href="{{route('agent.message.replay',$message->id)}}" class="btn btn-small indigo waves-effect">
                            <i class="material-icons left">replay</i>
                            <span>Replay</span>
                        </a>

                        <form class="right" action="{{route('agent.message.readunread')}}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="{{ $message->status }}">
                            <input type="hidden" name="messageid" value="{{ $message->id }}">

                            <button type="submit" class="btn btn-small orange waves-effect">
                                <i class="material-icons left">local_library</i>
                                @if($message->status)
                                    <span>Unread</span>
                                @else 
                                    <span>Read</span>
                                @endif
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')

@endsection