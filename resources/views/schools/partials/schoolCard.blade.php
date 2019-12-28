<article class="media school-card mb-small">
  <figure class="media-left">
    <p class="image is-32x32">
      <img class="is-rounded" :src="school.logo_path">
    </p>
    <p class="image is-32x32 mt-small">
      {{-- 23 --}}
      <span class="school_sh_name is-hidden-tablet mg_left-auto image__favicon--small">23</span>
    </p>
  </figure>
  <div class="media-content">
    <div class="field">
      <a :href="school.path" class="control has-text-black">
        <div class="is-size-5 is-flex-mobile school_header">
              <span v-text="school.name"></span>
        </div>
        <span class="has-text-black" v-text="school.excerpt"></span>
        <span ><strong>Read More</strong></span>
      </a>
    </div>
  </div>
  <figure class="media-right is-hidden-mobile">
    <p class="pt-all">
        
    </p>
  </figure>
</article>