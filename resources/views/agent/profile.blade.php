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
                    <div class="agent-content">
                        <h4 class="agent-title">PROFILE</h4>

                        <form action="{{route('agent.profile.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">person</i>
                                    <input id="name" name="name" type="text" value="{{ $profile->name }}" class="validate">
                                    <label for="name">Name</label>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">assignment_ind</i>
                                    <input id="username" name="username" type="text" value="{{ $profile->username or null }}" class="validate">
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" name="email" type="email" value="{{ $profile->email }}" class="validate">
                                    <label for="username">Email</label>
                                </div>
                                <div class="file-field input-field col s6">
                                    <div class="btn indigo">
                                        <span>Image</span>
                                        <input type="file" name="image">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="about" name="about" class="materialize-textarea">{{ $profile->about or null }}</textarea>
                                    <label for="about">About</label>
                                </div>
                            </div>

                            <div class="row">
                                <button class="btn waves-effect waves-light btn-large indigo darken-4" type="submit">
                                    Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>

                        </form>


                    </div>
                </div> <!-- /.col -->

            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('textarea#about').characterCounter();
    });

</script>
@endsection