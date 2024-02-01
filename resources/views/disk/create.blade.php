@extends('app.base')

@section('title','Argo create movie')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Películas</title>
</head>
<body>
    Disponible
<symbol id="disk" viewBox="0 0 16 16">
  <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h8V1H4zm8 8H4v6h8V9zM1 1v2h2V1H1zm2 3H1v2h2V4zM1 7v2h2V7H1zm2 3H1v2h2v-2zm-2 3v2h2v-2H1zM15 1h-2v2h2V1zm-2 3v2h2V4h-2zm2 3h-2v2h2V7zm-2 3v2h2v-2h-2zm2 3h-2v2h2v-2z"/>
</symbol>


<form action="{{ url('disk') }}" method="post" enctype="multipart/form-data">

    <!-- Solución de error por CSRF -->
    <!--<input type="hidden" name="_method" value="post">-->
    <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
    @csrf

    <!-- Inputs del formulario -->

    <div class="mb-3">

        <label for="title" class="form-label">disk title</label>

        <input type="text" class="form-control" id="title" name="title"  required value="{{ old('title') }}">

    </div>

    <div class="mb-3">

        <label for="idartist" class="form-label">disk artist</label>

        <!--<input type="text" class="form-control" id="idartist" name="idartist"  required value="{{ old('idartist') }}">-->
        <select required name="idartist" id="idartist" class="form-select"  >
    <option hidden value="" >Selecciona el artista</option>
    @foreach ($artists as $value => $label)
        <option value="{{ $value }}"{{ $idartist ==$value ? 'selected' : '' }} >{{$label}}</option>
    @endforeach
    
</select>

    <input type="hidden" name="idartist" value="{{ $idartist }}"/>
    <h1>{{ $artist->name }}</h1>

    </div>

    <div class="mb-3">

        <label for="year" class="form-label">disk year</label>

        <input type="number" class="form-control" id="year" name="year" step="1" min="1" max="9999" required value="{{ old('year') }}">

    </div>
    
    <div class="mb-3">

        <label for="year" class="form-label">cover</label>

        <input type="file" class="form-control" id="file" name="file">

    </div>

    <button type="submit" class="btn btn-success">add</button>

</form>
</body>
</html>


@endsection