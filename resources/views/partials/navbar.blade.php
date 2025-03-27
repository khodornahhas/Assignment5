<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Laravel Lab</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="/students">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('students.create')}}">Add Student</a>
        </li>
      </ul>
    </div>
  </div>
</nav>