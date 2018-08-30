@extends('backend.layouts.app')

@section('title', 'Create Sliders')

@push('styles')

    
@endpush


@section('content')

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>
                        CREATE SLIDER
                        <a href="{{route('admin.sliders.index')}}" class="waves-effect waves-light btn right headerightbtn">
                            <i class="material-icons left">arrow_back</i>
                            <span>BACK</span>
                        </a>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.sliders.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" class="form-control">
                                <label class="form-label">Title</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="description" rows="4" class="form-control no-resize"></textarea>
                                <label class="form-label">Description</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <img src="" id="slider-imgsrc" class="img-responsive">
                            <input type="file" name="image" id="slider-image-input" style="display:none;">
                            <button type="button" class="btn bg-grey btn-sm waves-effect m-t-15" id="slider-image-btn">
                                <i class="material-icons">image</i>
                                <span>UPLOAD IMAGE</span>
                            </button>
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
        $('#slider-image-btn').on('click', function(){
            $('#slider-image-input').click();
        });
        $('#slider-image-input').on('change', function(){
            showImage(this, '#slider-imgsrc');
        });
    })
</script>

@endpush
