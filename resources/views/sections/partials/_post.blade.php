<article class="media">
  <figure class="media-left">
    <p class="image is-64x64">
      <img class="is-rounded" src="{{asset($post->source->logo_path)}}">
    </p>
  </figure>
  <div class="media-content">
    <div class="field">
      <a href="{{$post->path()}}" class="control has-text-black">
        <div class="is-size-4 is-flex-mobile">
            {{$post->title}} 
            <span class="post_sh_name is-hidden-tablet">{{$post->source->short_name}}</span>
        </div>
        <span class="has-text-black ">{{$post->excerpt()}}</span>
        <span ><strong>Read More</strong></span>
      </a>
    </div>
  </div>
  <figure class="media-right is-hidden-mobile">
    <p class="pt-all">
        <span class="post_sh_name">{{$post->source->short_name}}</span>
    </p>
  </figure>
</article>