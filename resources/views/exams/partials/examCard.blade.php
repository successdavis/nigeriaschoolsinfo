<div class="tile is-4 is-parent">
  <div class="card mb-small">
    <header class="card-header">
      <p class="card-header-title is-flex justify-content-all">
        <span>{{$exam->short_name}}</span>
        <span>Status: {{$exam->registrationStatus()}}</span>
      </p>
  {{--     <a href="#" class="card-header-icon" aria-label="more options">
        <span class="icon">
          <i class="fas fa-angle-down" aria-hidden="true"></i>
        </span>
      </a> --}}
    </header>
    <div class="card-content">
      <div class="content">
        <p>{{$exam->excerpt()}}</p>
        <p>Reg Ends: {{$exam->registrationEndsAt()}}</p>
        <br>
      </div>
    </div>
    <footer class="exam card-footer">
      <a href="#" class="card-footer-item"><i class="fas fa-eye"></i> Watch</a>
      <a href="#" class="card-footer-item"><i class="fas fa-binoculars"></i>View</a>
    </footer>
  </div>
</div>