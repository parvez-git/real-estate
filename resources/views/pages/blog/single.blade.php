@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col s12 m8">

                    <div class="card">
                        <div class="card-image">
                            @if(Storage::disk('public')->exists('posts/'.$post->image))
                                <img src="{{Storage::url('posts/'.$post->image)}}" alt="{{$post->title}}">
                            @endif
                        </div>
                        <div class="card-content">
                            <span class="card-title" title="{{$post->title}}">{{ $post->title }}</span>
                            {!! $post->body !!}
                        </div>
                        <div class="card-action blog-action">
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

                            <a href="#" class="btn-flat disabled">
                                <i class="material-icons">visibility</i>
                                <span>{{$post->view_count}}</span>
                            </a>
                        </div>

                    </div>

                    <div class="card" id="comments">
                        <div class="p-15 grey lighten-4">
                            <h5 class="m-0">{{ $post->comments_count }} Comments</h5>
                        </div>
                        <div class="single-narebay p-15">

                            @foreach($comments as $comment)
                                @if($comment->parent == 0)
                                <div class="comment">
                                    <div class="author-image">
                                        <span style="background-image:url({{ Storage::url('users/'.$comment->users->image) }});"></span>
                                    </div>
                                    <div class="content">
                                        <div class="author-name">
                                            <strong>{{ $comment->users->name }}</strong>
                                            <span class="time">{{ $comment->created_at->diffForHumans() }}</span>

                                            @auth
                                                <span class="right replay" data-commentid="{{ $comment->id }}">Replay</span>
                                            @endauth

                                        </div>
                                        <div class="author-comment">
                                            {{ $comment->body }}
                                        </div>
                                    </div>
                                    <div id="comment-{{$comment->id}}"></div>
                                </div>
                                @endif

                                @foreach($comment->children as $comment)
                                    <div class="comment children">
                                        <div class="author-image">
                                            <span style="background-image:url({{ Storage::url('users/'.$comment->users->image) }});"></span>
                                        </div>
                                        <div class="content">
                                            <div class="author-name">
                                                <strong>{{ $comment->users->name }}</strong>
                                                <span class="time">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="author-comment">
                                                {{ $comment->body }}
                                            </div>
                                        </div>
                                        <div id="comment-{{$comment->id}}"></div>
                                    </div>
                                @endforeach

                            @endforeach

                            @auth
                                <div class="comment-box">
                                    <h6>Leave a comment</h6>
                                    <form action="{{ route('blog.comment',$post->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="parent" value="0">

                                        <textarea name="body" class="box"></textarea>
                                        <input type="submit" class="btn indigo" value="Comment">
                                    </form>
                                </div>
                            @endauth

                            @guest 
                                <div class="comment-login">
                                    <h6>Please Login to comment</h6>
                                    <a href="{{ route('login') }}" class="btn indigo">Login</a>
                                </div>
                            @endguest
                            
                        </div>
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
<script>
    $(document).on('click','span.right.replay',function(e){
        e.preventDefault();
        
        var commentid = $(this).data('commentid');

        $('#comment-'+commentid).empty().append(
            `<div class="comment-box">
                <form action="{{ route('blog.comment',$post->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent" value="1">
                    <input type="hidden" name="parent_id" value="`+commentid+`">
                    
                    <textarea name="body" class="box" placeholder="Leave a comment"></textarea>
                    <input type="submit" class="btn indigo" value="Comment">
                </form>
            </div>`
        );
    });
</script>
@endsection