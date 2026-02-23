<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm fixed-top">
  <div class="container-fluid px-4">
    <a class="navbar-brand" href="/">PosSehat</a>

    <div class="ms-auto">
      <form action="/logout" method="POST">
        @csrf
        <button class="btn btn-primary rounded-pill px-4">
          Keluar
        </button>
      </form>
    </div>
  </div>
</nav>
