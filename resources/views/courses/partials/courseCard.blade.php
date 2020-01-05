<div class="card mb-small">
  <div class="card-content">
    <p class="is-size-5" v-text="course.name"></p>
    <p class="subtitle is-size-7" >Faculty of: <span v-text="course.faculty.name"></span></p>
    <span class="has-text-black" v-text="course.excerpt"></span> <br>
  </div>
  <footer class="card-footer">
    <p class="card-footer-item">
      <span>
        <course_quick_view :name="course.slug" :course="course"></course_quick_view>
      </span>
    </p>
    <p class="card-footer-item">
      <span>
        View
      </span>
    </p>
    @if (auth()->user()->isAdmin())
      <p class="card-footer-item">
        <span>
          <a :href="'/courses/editcourse/' + course.slug">Edit</a>
        </span>
      </p>
    @endif
  </footer>
</div>