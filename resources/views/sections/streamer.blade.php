<div>
  @if (!empty($advertisements))
    <image-carousel :wraparound="true" :autoplay="true" >
      @foreach ($advertisements as $advert)
          <div style="width: 100%">
            <section class="hero is-medium is-primary is-bold" style="background-image: {{asset($advert->image_path)}}">
              <div class="hero-body">
                <div class="container">
                  <h1 class="is-size-2">{{$advert->name}}</h1>
                  <p>{{$advert->sypnosis}}</p>
                </div>
              </div>
            </section>
          </div>
      @endforeach    
   </image-carousel>
  @endif
</div>