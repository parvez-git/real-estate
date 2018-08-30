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

                    <h4 class="agent-title">DASHBOARD</h4>
                    
                    <div class="agent-content">

                        <div class="row">
                            <div class="col s12">
                                <div class="box indigo white-text p-30">
                                    <i class="material-icons left">comment</i>
                                    <span class="truncate uppercase bold font-18">Comments</span>
                                    <h4 class="m-t-10 m-b-0">{{ $commentcount }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <div class="box indigo white-text p-20">
                                    <i class="material-icons left font-18">comment</i>
                                    <span class="truncate uppercase bold">Recent Comments</span>
                                </div>
                                <div class="box-content">
                                    @foreach($comments as $key => $comment)
                                        <div class="grey lighten-4">
                                            <span class="border-bottom display-block p-15  grey-text-d-2">
                                                {{ ++$key }}. {{ $comment->body }}
                                                
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    {{ $comments->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
        
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')

@endsection