@component('posts.partials.post',['post' => $post])

    @slot('image')
        <a href="{{$post->source->path()}}">
        	<img class="is-rounded" src="{{asset($post->source->logo_path)}}" alt="{{$post->title}} thumbnail">
        </a>
    @endslot 

    @slot('title')
    	{{$post->title}} <br>
    @endslot 

    @slot('source')
    	<span class="post_sh_name is-hidden-tablet">{{$post->source->short_name}}</span>
    @endslot 

<!--     @slot('body')
        <span class="has-text-black ">{!! nl2br($post->excerpt()) !!}</span>
        <span ><strong>Read More</strong></span>
    @endslot -->
    @slot('table_short_name')
        <p class="pt-all">
        <span class="post_sh_name"><a class="has-text-black" href="{{$post->source->path()}}">{{$post->source->short_name}}</a></span>
    	</p>
    @endslot

@endcomponent
