<div class="card mb-small">
    <a :href="course.path" >
      <div class="card-content" style="padding: .8em;">
        <p class="is-size-5 has-text-black" v-text="course.name"></p>
    {{--    <p class="subtitle is-size-7" >Faculty of: <span v-text="course.faculty.name"></span></p>--}}
        <span class="has-text-black" v-text="course.excerpt"></span> <br>
      </div>
    </a>
  <footer class="card-footer">
    <p class="card-footer-item">
         <span v-text="course.duration + ' Yrs' ">
    </p>
    <p class="card-footer-item">
{{--      <span>--}}
{{--              Sal. <span v-text="course.salary.toLocaleString('en-US', { style: 'currency', currency: 'NGN' })">--}}
{{--      </span>--}}
    </p>
    @can('update courses')
        <p class="card-footer-item">
          <span>
            <a :href="'/home#/editcourse/' + course.slug">Edit</a>
          </span>
        </p>
    @endcan
  </footer>
</div>
