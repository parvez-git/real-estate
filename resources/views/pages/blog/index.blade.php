@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">
                <h4 class="section-heading">Blog Posts</h4>
            </div>
            <div class="row">

                <div class="col s12 m8">

                    @foreach($posts as $post)
                        <div class="card horizontal">
                            <div>
                                <div class="card-content">
                                    @if(Storage::disk('public')->exists('posts/'.$post->image) && $post->image)
                                        <div class="card-image blog-content-image">
                                            <img src="{{Storage::url('posts/'.$post->image)}}" alt="{{$post->title}}">
                                        </div>
                                    @endif
                                    <span class="card-title">
                                        <a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}</a>
                                    </span>
                                    {!! str_limit($post->body,120) !!}
                                </div>
                                <div class="card-action blog-action clearfix">
                                    <a href="{{ route('blog.author',$post->user->username) }}" class="btn-flat">
                                        <i class="material-icons">person</i>
                                        <span>{{$post->user->name}}</span>
                                    </a>
                                    <a href="#" class="btn-flat disabled">
                                        <i class="material-icons">watch_later</i>
                                        <span>{{$post->created_at->diffForHumans()}}</span>
                                    </a>
                                    @foreach($post->categories as $key => $category)
                                        <a href="{{ route('blog.categories',$category->slug) }}" class="btn-flat">
                                            <i class="material-icons">folder</i>
                                            <span>{{$category->name}}</span>
                                        </a>
                                    @endforeach
                                    @foreach($post->tags as $key => $tag)
                                        <a href="{{ route('blog.tags',$tag->slug) }}" class="btn-flat">
                                            <i class="material-icons">label</i>
                                            <span>{{$tag->name}}</span>
                                        </a>
                                    @endforeach
                                    
                                    <a href="{{ route('blog.show',$post->slug) . '#comments' }}" class="btn-flat">
                                        <i class="material-icons">comment</i>
                                        <span>{{$post->comments_count}}</span>
                                    </a>
                                    <a href="#" class="btn-flat disabled">
                                        <i class="material-icons">visibility</i>
                                        <span>{{$post->view_count}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <div class="m-t-30 m-b-60 center">
                        {{ $posts->appends(['month' => Request::get('month'), 'year' => Request::get('year')])->links() }}
                    </div>
        
                </div>

                <div class="col s12 m4">

                    @include('pages.blog.sidebar')

                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')

@endsection