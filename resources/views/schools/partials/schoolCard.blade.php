<div class="columns">
  <div class="column is-9">
    <article class="media school-card mb-small">
      <figure class="media-left">
        <p class="image is-32x32">
          <img class="is-rounded" :src="school.logo_path">
        </p>
        <p class="image is-32x32 mt-small">
          {{-- 23 --}}
          <span class="school_sh_name  mg_left-auto image__favicon--small" v-text="school.courses_count"></span>
        </p>
        <p class="image is-32x32 mt-small is-hidden-tablet ">
          <school-quickview :school="school" :name="school.name"></school-quickview>
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
    </article>
  </div>
  <div class="column is-3 is-hidden-touch">
        <school-quickview :school="school" :name="school.name"></school-quickview>
        {{-- <button @click="$modal.show(school.name)">Show Courses</button> --}}
  </div>
</div>