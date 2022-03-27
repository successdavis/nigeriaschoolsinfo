<div class="card mb-small">
  <div class="card-content" style="padding: .8em;">
    <a :href="course.path" class="is-size-5 has-text-black" v-text="course.name"></a>
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
        <!-- <a :href="course.path">View</a> -->
      </span>
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