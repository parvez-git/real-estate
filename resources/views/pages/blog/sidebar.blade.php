<div class="card">
    <div class="card-content">
        <h3 class="font-18 m-t-0 bold uppercase">Categories</h3>
        <ul>
            @foreach($categories as $category)
                <li class="category-bg-image" style="background-image:url({{Storage::url('category/slider/'.$category->image)}});">

                    <a href="{{ route('blog.categories',$category->slug) }}">

                        <span class="left">{{ $category->name }}</span>

                        <span class="right">{{ $category->posts_count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <h3 class="font-18 m-t-0 bold uppercase">Archives</h3>
        <ul class="collection">
            @foreach($archives as $stats)
                <li class="collection-item">

                    <a href="/blog/?month={{ $stats['month'] }}&year={{ $stats['year'] }}" class="indigo-text text-darken-4">

                        {{ $stats['month'] . ' ' . $stats['year'] }}

                        <span class="badge indigo darken-1 white-text">{{ $stats['published'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <h3 class="font-18 m-t-0 bold uppercase">Tags</h3>

        @foreach($tags as $tag)

            <a href="{{ route('blog.tags',$tag->slug) }}">

                <span class="btn-small indigo white-text m-b-5 card-no-shadow">{{ $tag->name }}</span>

            </a>

        @endforeach
    </div>
</div>