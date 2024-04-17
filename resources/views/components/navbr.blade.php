{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/AddMagazines">Magazines</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/AddUser">Utilisateurs</a>
      </li>
    </ul>
  </div>
</nav> --}}

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">Star-Direct</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href=" {{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href=" {{ route('Magazines.index') }} ">Magazines</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('Users.index') }}">Utilisateurs</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>