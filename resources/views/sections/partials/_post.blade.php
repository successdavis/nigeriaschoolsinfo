<article class="media">
  <figure class="media-left">
    <p class="image is-64x64">
      <img class="is-rounded" src="{{asset($post->source->logo_path)}}">
    </p>
  </figure>
  <div class="media-content">
    <div class="field">
      <a href="{{$post->path()}}" class="control has-text-black">
        <div class="is-size-4 is-flex-mobile post_header">
            <span class="post_header--title">
              {{$post->title}} <br>
              <span class="is-size-7">posted: {{$post->created_at->diffForHumans()}}</span>
            </span>
            <span class="post_sh_name is-hidden-tablet">{{$post->source->short_name}}</span>
        </div>
        <span class="has-text-black ">{!! nl2br($post->excerpt()) !!}</span>
        <span ><strong>Read More</strong></span>
      </a>
    </div>
  </div>
  <figure class="media-right is-hidden-mobile">
    <p class="pt-all">
        <span class="post_sh_name"><a class="has-text-black" href="{{$post->source->path()}}">{{$post->source->short_name}}</a></span>
    </p>
  </figure>
</article>