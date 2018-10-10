<div class="row no-gutters">
    <div class="col-md-12">
        <div class="row no-gutters">

           @if(isset($top_article))
               @foreach($top_article as $value)
                    <div class="col-md-3">
                        <div class="hero-card --small --border-top --border-right">
                            <a class="hero-media-image" href="{{ route('single.article',$value->id) }}">
                                <img src="{{ asset('article/'.$value->image) }}">
                            </a>
                            <div class="hero-card-content">
                                <div class="content-article">
                                    <a href="{{ route('category_by_post',$value->category_id) }}">
                                        <span class="byline byline-badge lifestyle">{{ isset($value->category->name)?$value->category->name:'' }}</span>
                                    </a>
                                    <h2 class="hero-card-heading">
                                        <a href="{{ route('single.article',$value->id) }}" style="font-weight: bold">
                                            <span style="font-size: 20px;">{{ ucfirst($value->title) }}</span>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
           @endif

        </div>
    </div>
</div>