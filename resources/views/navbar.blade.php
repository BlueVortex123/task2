<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Task 2</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('view.providers') }}">Providers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('view.products') }}">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('view.contracts') }}">Contracts</a>
      </li>
    </ul>
  </div>
</nav>