@extends('backend.layouts.app')

@section('title', 'Edit Slider')

@push('styles')

    
@endpush


@section('content')

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>
                        EDIT SLIDER
                        <a href="{{route('admin.sliders.index')}}" class="waves-effect waves-light btn right headerightbtn">
                            <i class="material-icons left">arrow_back</i>
                            <span>BACK</span>
                        </a>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.sliders.update',$slider->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <label class="form-label">Title</label>
                            <div class="form-line">
                                <input type="text" name="title" class="form-control" value="{{$slider->title}}">
                            </div>
                        </div>

                        @if(Storage::disk('public')->exists('slider/'.$slider->image))
                            <div class="form-group">
                                <img src="{{Storage::url('slider/'.$slider->image)}}" id="slider-imgsrc-edit" alt="{{$slider->title}}" class="img-responsive img-rounded">
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="file" name="image" id="slider-image-input-edit" style="display:none;">
                            <button type="button" class="btn bg-grey btn-sm waves-effect m-t-15" id="slider-image-btn-edit">
                                <i class="material-icons">image</i>
                                <span>UPLOAD IMAGE</span>
                            </button>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <div class="form-line">
                                <textarea name="description" rows="4" class="form-control no-resize">{{$slider->description}}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">update</i>
                            <span>Update</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

<script>
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
    $('#slider-image-btn-edit').on('click', function(){
        $('#slider-image-input-edit').click();
    });
    $('#slider-image-input-edit').on('change', function(){
        showImage(this, '#slider-imgsrc-edit');
    });
</script>

@endpush
