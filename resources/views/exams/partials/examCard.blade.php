<div class="tile is-4 is-parent" v-for="exam in exams">
  <div class="card mb-small">
    <header class="card-header">
      <p class="card-header-title is-flex justify-content-all">
        <span v-text="exam.short_name"></span>
        <span>Status: <span v-text="exam.regStatus"></span></span>
      </p>
    </header>
    <div class="card-content">
      <div class="content">
        <p v-text="exam.sypnosis"></p>
        <p>Reg Ends: <span v-text="exam.endsAt"></span></p>
        <br>
      </div>
    </div>
    <footer class="exam card-footer">
      <a href="#" class="card-footer-item"><i class="fas fa-eye"></i> Watch</a>
      <a :href="'/exams/' + exam.slug" class="card-footer-item"><i class="fas fa-binoculars"></i>View</a>
    </footer>
  </div>
</div>