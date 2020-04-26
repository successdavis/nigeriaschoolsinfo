<article class="media">
  <figure class="media-left">
    <p class="image is-64x64">
      {{$image}}
    </p>
  </figure>
  <div class="media-content">
    <div class="field">
      <a href="{{$post->path()}}" class="control has-text-black">
        <div class="is-size-4 is-flex-mobile post_header">
            <span class="post_header--title">
              {{$title}}
            </span>
            {{-- {{$source}} --}}
        </div>
        {{$body}}
      </a>
    </div>
  </div>
  <figure class="media-right is-hidden-mobile">
    {{$table_short_name}}
  </figure>
</article>