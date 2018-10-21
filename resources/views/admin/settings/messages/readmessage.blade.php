@extends('backend.layouts.app')

@section('title', 'Read Message')

@push('styles')

    
@endpush


@section('content')

    <div class="block-header">
        <a href="{{route('admin.message')}}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>READ MESSAGE</h2>
                </div>
                <div class="body">
                    <h5>From: {{ $message->name }} <<em>{{ $message->email }}></em></h5>
                    <hr>

                    <h5>Message</h5>
                    <p>{!! $message->message !!}</p>
                    <hr>

                    <a href="{{route('admin.message.replay',$message->id)}}" class="btn btn-indigo btn-sm waves-effect">
                        <i class="material-icons">replay</i>
                        <span>Replay</span>
                    </a>

                    <form class="right" action="{{route('admin.message.readunread')}}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="{{ $message->status }}">
                        <input type="hidden" name="messageid" value="{{ $message->id }}">

                        <button type="submit" class="btn btn-warning btn-sm waves-effect">
                            <i class="material-icons">local_library</i>
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

@endsection


@push('scripts')

@endpush
