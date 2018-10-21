@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">
                <h4 class="section-heading">Gallery</h4>
            </div>
            <div class="row">

                @foreach($galleries as $gallery)
                    @if(Storage::disk('public')->exists('gallery/'.$gallery->image) && $gallery->image)
                        <div class="col s12 m4">
                            <div class="card">
                                <div class="card-image">
                                    <span class="card-image-bg materialboxed" style="background-image:url({{Storage::url('gallery/'.$gallery->image)}});"></span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>

            <div class="m-t-30 m-b-60 center">
                {{ $galleries->links() }}
            </div>

        </div>
    </section>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.materialboxed').materialbox();
    });
</script>
@endsection