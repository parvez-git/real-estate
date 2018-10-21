@extends('backend.layouts.app')

@section('title', 'Profile')

@push('styles')

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">

        <div class="col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>
                        PROFILE
                        <a href="{{route('admin.changepassword')}}" class="btn waves-effect waves-light right headerightbtn">
                            <i class="material-icons left">lock</i>
                            <span>CHANGE PASSWORD </span>
                        </a>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.profile')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" value="{{ $profile->name or null }}">
                                <label class="form-label">Name</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="username" class="form-control" value="{{ $profile->username or null }}">
                                <label class="form-label">User Name</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="email" name="email" class="form-control" value="{{ $profile->email or null }}">
                                <label class="form-label">Email</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="file" name="image">
                            {{-- <img src="" id="profile-imgsrc" class="img-responsive">
                            <input type="file" name="image" id="profile-image-input" style="display:none;">
                            <button type="button" class="btn bg-grey btn-sm waves-effect m-t-15" id="profile-image-btn">
                                <i class="material-icons">image</i>
                                <span>UPLOAD IMAGE</span>
                            </button> --}}
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="about" rows="4" class="form-control no-resize">{{ $profile->about or null }}</textarea>
                                <label class="form-label">About Us</label>
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

<script>
    $(function(){
        function showImage(fileInput,imgID){
            if (fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e){
                    $(imgID).attr('src',e.target.result);
                    $(imgID).attr('alt',fileInput.files[0].name);
                }
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
        $('#profile-image-btn').on('click', function(){
            $('#profile-image-input').click();
        });
        $('#profile-image-input').on('change', function(){
            showImage(this, '#profile-imgsrc');
        });
    })
</script>

@endpush
