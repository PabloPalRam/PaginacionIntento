@extends('app.base')

@section('title', 'Argo Movie List')

@section('content')

@include('modal.deletemovie')

<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Director</th>
          <th scope="col">Year</th>
          <th scope="col">Genre</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($movies as $movie)
            <tr>
                <td>{{ $movie->id }}</td>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->director }}</td>
                <td>{{ $movie->year }}</td>
                <td>{{ $movie->genre }}</td>
                <td>
                    <a class="btn-primary btn" href="{{ url('movie/' . $movie->id) }}">link to show</a>
                    <a class="btn-danger btn" href="{{ url('movie/' . $movie->id . '/edit') }}">link to edit</a>
                    <form data-movie="{{ $movie->title }}" class="formDelete" action="{{ url('movie/' . $movie->id) }}" method="post" style="display: inline-block">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-warning">link to delete</button>
                    </form>
                    <a data-url="{{ url('movie/' . $movie->id) }}" class="btn-secondary btn hrefDelete" href="">link to delete v2</a>
                    <button data-url="{{ url('movie/' . $movie->id) }}" data-title="{{ $movie->title }}" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteMovieModal">
                      link to delete v3
                    </button>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    <a class="btn-info btn" href="{{ url('movie/create') }}">link to create</a>
    <form id="formDeleteV2" action="{{ url('movie/16') }}" method="post">
      @csrf
      @method('delete')
    </form>
</div>

<script>
  //solucion 1
  const forms = document.querySelectorAll(".formDelete");
  forms.forEach(function(form) {
      form.onsubmit = (event) => {
        return confirm('Seguro que quieres borrar ' + event.target.dataset.movie + '?');
      };
  });
  //solucion 2
  const ahrefs = document.querySelectorAll(".hrefDelete");
  const formDelete = document.getElementById('formDeleteV2');
  ahrefs.forEach(function(ahref) {
      ahref.onclick = (event) => {
        event.preventDefault();
        if(confirm('¿Seguro?')) {
          let url = event.target.dataset.url;
          formDelete.action = url;
          formDelete.submit();
        }
        //return confirm('Seguro que quieres borrar ' + event.target.dataset.movie + '?');
      };
  });
  //solucion 3
  const deleteMovieModal = document.getElementById('deleteMovieModal');
  const movieTitle = document.getElementById('movieTitle');
  const formDeleteV3 = document.getElementById('formDeleteV3');
  deleteMovieModal.addEventListener('show.bs.modal', event => {
      console.log('show');
      alert(event.relatedTarget.dataset.title + ' ' + event.relatedTarget.dataset.url);
      movieTitle.innerHTML = event.relatedTarget.dataset.title;
      formDeleteV3.action=event.relatedTarget.dataset.url;
  });
</script>
@endsection



