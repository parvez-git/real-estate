@extends('frontend.layouts.app')

@section('styles')
<style>
    #map {
        height: 320px;
    }

    .jssorl-009-spin img {
        animation-name: jssorl-009-spin;
        animation-duration: 1.6s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    @keyframes jssorl-009-spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .jssora106 {display:block;position:absolute;cursor:pointer;}
    .jssora106 .c {fill:#fff;opacity:.3;}
    .jssora106 .a {fill:none;stroke:#000;stroke-width:350;stroke-miterlimit:10;}
    .jssora106:hover .c {opacity:.5;}
    .jssora106:hover .a {opacity:.8;}
    .jssora106.jssora106dn .c {opacity:.2;}
    .jssora106.jssora106dn .a {opacity:1;}
    .jssora106.jssora106ds {opacity:.3;pointer-events:none;}

    .jssort101 .p {position: absolute;top:0;left:0;box-sizing:border-box;background:#000;}
    .jssort101 .p .cv {position:relative;top:0;left:0;width:100%;height:100%;box-sizing:border-box;z-index:1;}
    .jssort101 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;visibility:hidden;}
    .jssort101 .p:hover .cv, .jssort101 .p.pdn .cv {border:none;border-color:transparent;}
    .jssort101 .p:hover{padding:2px;}
    .jssort101 .p:hover .cv {background-color:rgba(0,0,0,6);opacity:.35;}
    .jssort101 .p:hover.pdn{padding:0;}
    .jssort101 .p:hover.pdn .cv {border:2px solid #fff;background:none;opacity:.35;}
    .jssort101 .pav .cv {border-color:#fff;opacity:.35;}
    .jssort101 .pav .a, .jssort101 .p:hover .a {visibility:visible;}
    .jssort101 .t {position:absolute;top:0;left:0;width:100%;height:100%;border:none;opacity:.6;}
    .jssort101 .pav .t, .jssort101 .p:hover .t{opacity:1;}
</style>
@endsection

@section('content')

    <!-- SINGLE PROPERTY SECTION -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col s12 m8">
                    <div class="single-title">
                        <h4 class="single-title" title="{{ $property->title }}">{{ $property->title }}</h4>
                    </div>

                    <div class="address m-b-30">
                        <i class="small material-icons left">place</i>
                        <span class="font-18">{{ $property->address }}</span>
                    </div>

                    <div>
                        @if($property->featured == 1)
                            <a class="btn-floating btn-small disabled"><i class="material-icons">star</i></a>
                        @endif

                        <span class="btn btn-small disabled b-r-20">Bedroom: {{ $property->bedroom}} </span>
                        <span class="btn btn-small disabled b-r-20">Bathroom: {{ $property->bathroom}} </span>
                        <span class="btn btn-small disabled b-r-20">Area: {{ $property->area}} Sq Ft</span>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div>
                        <h4 class="left">${{ $property->price }}</h4>
                        <button type="button" class="btn btn-small m-t-25 right disabled b-r-20"> For {{ $property->purpose }}</button>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col s12 m8">

                    @if(!$property->gallery->isEmpty())
                        <div class="single-slider">
                            @include('pages.properties.slider')
                        </div>
                    @else
                        <div class="single-image">
                            @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                <img src="{{Storage::url('property/'.$property->image)}}" alt="{{$property->title}}" class="imgresponsive">
                            @endif
                        </div>
                    @endif

                    <div class="single-description p-15 m-b-15 border2 border-top-0">
                        {!! $property->description !!}
                    </div>

                    <div>
                        @if($property->features)
                            <ul class="collection with-header">
                                <li class="collection-header grey lighten-4"><h5 class="m-0">Features</h5></li>
                                @foreach($property->features as $feature)
                                    <li class="collection-item">{{$feature->name}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="card-no-box-shadow card">
                        <div class="p-15 grey lighten-4">
                            <h5 class="m-0">Floor Plan</h5>
                        </div>
                        <div class="card-image">
                            @if(Storage::disk('public')->exists('property/'.$property->floor_plan) && $property->floor_plan)
                                <img src="{{Storage::url('property/'.$property->floor_plan)}}" alt="{{$property->title}}" class="imgresponsive">
                            @endif
                        </div>
                    </div>

                    <div class="card-no-box-shadow card">
                        <div class="p-15 grey lighten-4">
                            <h5 class="m-0">Location</h5>
                        </div>
                        <div class="card-image">
                            <div id="map"></div>
                        </div>
                    </div>

                    <div class="card-no-box-shadow card">
                        <div class="p-15 grey lighten-4">
                            <h5 class="m-0">Near By</h5>
                        </div>
                        <div class="single-narebay p-15">
                            {!! $property->nearby !!}
                        </div>
                    </div>

                    <div class="card-no-box-shadow card">
                        <div class="p-15 grey lighten-4">
                            <h5 class="m-0">{{ $property->comments_count }} Comments</h5>
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

                                @foreach($comment->children as $commentchildren)
                                    <div class="comment children">
                                        <div class="author-image">
                                            <span style="background-image:url({{ Storage::url('users/'.$commentchildren->users->image) }});"></span>
                                        </div>
                                        <div class="content">
                                            <div class="author-name">
                                                <strong>{{ $commentchildren->users->name }}</strong>
                                                <span class="time">{{ $commentchildren->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="author-comment">
                                                {{ $commentchildren->body }}
                                            </div>
                                        </div>
                                        <div id="comment-{{$commentchildren->id}}"></div>
                                    </div>
                                @endforeach

                            @endforeach

                            @auth
                                <div class="comment-box">
                                    <h6>Leave a comment</h6>
                                    <form action="{{ route('property.comment',$property->id) }}" method="POST">
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
                {{-- End ./COL M8 --}}

                <div class="col s12 m4">
                    <div class="clearfix">

                        <div>
                            <ul class="collection with-header m-t-0">
                                <li class="collection-header grey lighten-4">
                                    <h5 class="m-0">Contact with Agent</h5>
                                </li>
                                <li class="collection-item p-0">
                                    @if($property->user)
                                        <div class="card horizontal card-no-shadow">
                                            <div class="card-image p-l-10 agent-image">
                                                <img src="{{Storage::url('users/'.$property->user->image)}}" alt="{{ $property->user->username }}" class="imgresponsive">
                                            </div>
                                            <div class="card-stacked">
                                                <div class="p-l-10 p-r-10">
                                                    <h5 class="m-t-b-0">{{ $property->user->name }}</h5>
                                                    <strong>{{ $property->user->email }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-l-10 p-r-10">
                                            <p>{{ $property->user->about }}</p>
                                            <a href="{{ route('agents.show',$property->agent_id) }}" class="profile-link">Profile</a>
                                        </div>
                                    @endif
                                </li>

                                <li class="collection agent-message">
                                    <form class="agent-message-box" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="agent_id" value="{{ $property->user->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                                            
                                        <div class="box">
                                            <input type="text" name="name" placeholder="Your Name">
                                        </div>
                                        <div class="box">
                                            <input type="email" name="email" placeholder="Your Email">
                                        </div>
                                        <div class="box">
                                            <input type="number" name="phone" placeholder="Your Phone">
                                        </div>
                                        <div class="box">
                                            <textarea name="message" placeholder="Your Msssage"></textarea>
                                        </div>
                                        <div class="box">
                                            <button id="msgsubmitbtn" class="btn waves-effect waves-light w100 indigo" type="submit">
                                                SEND
                                                <i class="material-icons left">send</i>
                                            </button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <ul class="collection with-header">
                                <li class="collection-header grey lighten-4">
                                    <h5 class="m-0">Related Properties</h5>
                                </li>
                                @foreach($relatedprop as $property)
                                    <li class="collection-item p-0">
                                        <a href="{{ route('property.show',$property->id) }}">
                                            <div class="card horizontal card-no-shadow m-0">
                                                @if($property->image)
                                                <div class="card-image">
                                                    <img src="{{Storage::url('property/'.$property->image)}}" alt="{{$property->title}}" class="imgresponsive">
                                                </div>
                                                @endif
                                                <div class="card-stacked">
                                                    <div class="p-l-10 p-r-10">
                                                        <h6 title="{{$property->title}}">{{ str_limit( $property->title, 18 ) }}</h6>
                                                        <strong>&dollar;{{$property->price}}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('scripts')

    <script>
        $(function(){

            // COMMENT
            $(document).on('click','span.right.replay',function(e){
                e.preventDefault();
                
                var commentid = $(this).data('commentid');

                $('#comment-'+commentid).empty().append(
                    `<div class="comment-box">
                        <form action="{{ route('property.comment',$property->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent" value="1">
                            <input type="hidden" name="parent_id" value="`+commentid+`">
                            
                            <textarea name="body" class="box" placeholder="Leave a comment"></textarea>
                            <input type="submit" class="btn indigo" value="Comment">
                        </form>
                    </div>`
                );
            });

            // MESSAGE
            $(document).on('submit','.agent-message-box',function(e){
                e.preventDefault();

                var data = $(this).serialize();
                var url = "{{ route('property.message') }}";
                var btn = $('#msgsubmitbtn');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    beforeSend: function() {
                        $(btn).addClass('disabled');
                        $(btn).empty().append('LOADING...<i class="material-icons left">rotate_right</i>');
                    },
                    success: function(data) {
                        if (data.message) {
                            M.toast({html: data.message, classes:'green darken-4'})
                        }
                    },
                    error: function(xhr) {
                        M.toast({html: xhr.statusText, classes: 'red darken-4'})
                    },
                    complete: function() {
                        $('form.agent-message-box')[0].reset();
                        $(btn).removeClass('disabled');
                        $(btn).empty().append('SEND<i class="material-icons left">send</i>');
                    },
                    dataType: 'json'
                });

            })
        })
    </script>

    <script src="{{ asset('frontend/js/jssor.slider.min.js') }}"></script>
    <script>
        jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
            {$Duration:1200,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
            {$Duration:1200,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

            var jssor_1_options = {
            $AutoPlay: 1,
            $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
            },
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
            },
            $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $SpacingX: 5,
                $SpacingY: 5
            }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };

        @if(!$property->gallery->isEmpty())
            jssor_1_slider_init();
        @endif

    </script>
    <script>
        function initMap() {
            var propLatLng = {
                lat: <?php echo $property->location_latitude; ?>,
                lng: <?php echo $property->location_longitude; ?>
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: propLatLng
            });

            var marker = new google.maps.Marker({
                position: propLatLng,
                map: map,
                title: '<?php echo $property->title; ?>'
            });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRLaJEjRudGCuEi1_pqC4n3hpVHIyJJZA&callback=initMap">
    </script>
@endsection