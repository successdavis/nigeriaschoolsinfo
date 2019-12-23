<article class="media">
  <figure class="media-left">
    <p class="image is-64x64">
      <img class="is-rounded" src="{{asset($post->source->logo_path)}}">
    </p>
  </figure>
  <div class="media-content">
    <div class="field">
      <a href="{{$post->path()}}" class="control has-text-black">
        <h3 class="is-size-4">{{$post->title}}</h3>
        <span class="has-text-black">{{$post->excerpt()}}</span>
        <span ><strong>Read More</strong></span>
      </a>
    </div>
  </div>
  <figure class="media-right">
    <p class="pt-all">
      {{$post->source->type}}
    </p>
  </figure>
</article>