@extends('backend.layouts.app')

@section('title', 'Change Password')

@push('styles')

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">

        <div class="col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>CHANGE PASSWORD</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.changepassword')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" name="currentpassword" class="form-control">
                                <label class="form-label">Current Password</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" name="newpassword" class="form-control">
                                <label class="form-label">New Password</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" name="newpassword_confirmation" class="form-control">
                                <label class="form-label">Confirm New Password</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">save</i>
                            <span>SAVE</span>
                        </button>

                    </form>
                    
                </div>
            </div>
        </div>

    </div>

@endsection


@push('scripts')


@endpush
