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

                    <h4 class="agent-title">DASHBOARD</h4>
                    
                    <div class="agent-content">

                        <div class="row">
                            <div class="col s6">
                                <div class="box indigo white-text p-30">
                                    <i class="material-icons left">location_city</i>
                                    <span class="truncate uppercase bold font-18">Properties</span>
                                    <h4 class="m-t-10 m-b-0">{{ $propertytotal }}</h4>
                                </div>
                            </div>
                            <div class="col s6">
                                <div class="box indigo white-text p-30">
                                    <i class="material-icons left">mail</i>
                                    <span class="truncate uppercase bold font-18">Messages</span>
                                    <h4 class="m-t-10 m-b-0">{{ $messagetotal }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s6">
                                <div class="box indigo white-text p-20">
                                    <i class="material-icons left font-18">location_city</i>
                                    <span class="truncate uppercase bold">Recent Properties</span>
                                </div>
                                <div class="box-content">
                                    @foreach($properties as $key => $property)
                                    <div class="grey lighten-4">
                                        <a href="{{route('property.show',$property->slug)}}" target="_blank" class="border-bottom display-block p-15  grey-text-d-2">
                                            {{ ++$key }}. {{ str_limit($property->title, 28) }}
                                            <span class="right">&dollar;{{ $property->price }}</span>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        
                            <div class="col s6">
                                <div class="box indigo white-text p-20">
                                    <i class="material-icons left font-18">mail</i>
                                    <span class="truncate uppercase bold">Recent Mails</span>
                                </div>
                                <div class="box-content">
                                    @foreach($messages as $message)
                                    <div class="grey lighten-4">
                                        <a href="" class="border-bottom display-block p-15 grey-text-d-2">
                                            <strong>{{ strtok($message->name, " ") }}:</strong>
                                            <span class="p-l-5">{{ str_limit($message->message, 25) }}</span>
                                        </a>
                                    </div>
                                    @endforeach
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