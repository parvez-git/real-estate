@extends('backend.layouts.app')

@section('title', 'Replay Message')

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
                    <h2>REPLAY MESSAGE</h2>
                </div>
                <div class="body">
                    @if($message->user_id)
                        <form action="{{ route('admin.message.send') }}" method="POST">
                            @csrf

                            <input type="hidden" name="agent_id" value="{{ $message->user_id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                            <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                            <div class="form-group form-float">
                                <h5>Replay To: {{ $message->email }}</h5>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" name="phone" class="form-control">
                                    <label class="form-label">Phone</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="message" rows="4" class="form-control no-resize"></textarea>
                                    <label class="form-label">Message</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                                <i class="material-icons">replay</i>
                                <span>Replay</span>
                            </button>
                        </form>

                    @else 
                        {{-- MAIL FORM --}}
                        <form action="{{ route('admin.message.mail') }}" method="POST">
                            @csrf
                            <input type="hidden" name="name" value="{{ $message->name }}">
                            <input type="hidden" name="mailfrom" value="{{ auth()->user()->email }}">

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" name="email" class="form-control" value="{{ $message->email }}" readonly>
                                    <label class="form-label">TO</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="subject" class="form-control">
                                    <label class="form-label">Subject</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="message" rows="4" class="form-control no-resize"></textarea>
                                    <label class="form-label">Message</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                                <i class="material-icons">replay</i>
                                <span>SEND</span>
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

@endpush
