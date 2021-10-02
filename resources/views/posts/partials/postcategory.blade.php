@component('posts.partials.post',['post' => $post])

    @slot('image')
    	<img class="mt-small" src="{{$post->featured_image}}" alt="{{$post->title}} thumbnail">
    @endslot 

    @slot('title')
    	{{$post->title}} <br>
      <span class="is-size-7">posted: {{$post->created_at->diffForHumans()}}</span>
    @endslot 

    @slot('source')
    	<span class="post_sh_name is-hidden-tablet">{{$post->source->short_name}}</span>
    @endslot 

 <!--    @slot('body')
        <span class="has-text-black ">{!! nl2br($post->excerpt()) !!}</span>
        <span ><strong>Read More</strong></span>
    @endslot -->
    @slot('table_short_name')
        <p class="pt-all">
        <span class="post_sh_name"><a class="has-text-black" href="{{$post->source->path()}}">{{$post->source->title}}</a></span>
    	</p>
    @endslot

@endcomponent
