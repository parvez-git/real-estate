@extends('backend.layouts.app')

@section('title', 'Create Gallery')

@push('styles')

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">
        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>ALBUM LIST</h2>
                </div>
                <div class="body">
                    <div class="row">
                        @foreach($albums as $album)
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="card mb0">
                                <a href="{{ route('admin.album.gallery',$album->id) }}">
                                    <div class="header bg-indigo">
                                        <h2>{{$album->name}}</h2>
                                    </div>
                                    <div class="body">
                                        @if(!empty($album->galleryimages))
                                            @foreach($album->galleryimages as $key => $galleryimage)
                                                @if($key == 0)
                                                    <span style="background-image:url({{Storage::url('gallery/'.$galleryimage->image)}});background-size:cover;height:100px;display:block;background-repeat:no-repeat;background-position:center;"></span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>CREATE ALBUM</h2>
                </div>
                <div class="body">

                    <form action="{{route('admin.album.store')}}" method="POST">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" required>
                                <label class="form-label">Album Name</label>
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
