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
                    <div class="agent-content">
                        <h4 class="agent-title">Change Password</h4>

                        <form action="{{route('user.changepassword.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock_open</i>
                                <input id="currentpassword" name="currentpassword" type="password" class="validate">
                                <label for="currentpassword">Current Password</label>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="newpassword" name="newpassword" type="password" class="validate">
                                <label for="newpassword">New Password</label>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock</i>
                                <input id="new-password_confirmation" name="newpassword_confirmation" type="password" class="validate">
                                <label for="new-password_confirmation">Confirm New Password</label>
                            </div>

                            <button class="btn waves-effect waves-light indigo darken-4 m-l-30" type="submit">
                                Submit
                                <i class="material-icons right">send</i>
                            </button>

                        </form>


                    </div>
                </div> <!-- /.col -->

            </div>
        </div>
    </section>

@endsection

@section('scripts')

@endsection