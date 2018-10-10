<div class="sports-top">

    <div class="s-grid-left">

        <div class="cricket">
            <header>
                <h3 class="title-head">Developing</h3>
            </header>
            @foreach($article as $value)
            <div class="s-grid-small">
                <div class="sc-image">
                    <a href="single.html"><img src="images/bus4.jpg" alt="" /></a>
                </div>
                <div class="sc-text">
                    <h6>{{ $value->title }}</h6>
                    <a class="power" href="single.html">It is a long established fact that a reader</a>
                    <p class="date">On Jul 19, 2015</p>
                    <a class="reu" href="single.html"><img src="images/more.png" alt="" /></a>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            @endforeach
        </div>

    </div>

</div>