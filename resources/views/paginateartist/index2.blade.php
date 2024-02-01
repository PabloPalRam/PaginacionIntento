@extends('app.base')

@section('title', 'Argo Artist Paginate List')

@section('content')

<!--<div>
  <form>
    <select name="rowsPerPage" id="">
      @foreach($rpps as $index => $value)
        <option value="{{$index}}" @if($rpp == $index) selected @endif>{{$index}}</option>
      @endforeach
    </select>
    <button type="submit">view</button>
  </form>
</div>-->
<div>
    <form>
        <select name="rowsPerPage" id="" onchange="this.form.submit()">
            @foreach($rpps as $index => $value)
                <option value="{{ url('paginateartist', ['rowsPerPage' => $index, 'pages' => $pages]) }}"
                        @if($rpp == $index) selected @endif>
                    {{ $index }}
                </option>
            @endforeach
        </select>
        <button type="submit">view</button>
    </form>
</div>
<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">name</th>
        </tr>
      </thead>
      <tbody>
        @foreach($artists as $artist)
            <tr>
                <td>{{ $artist->id }}</td>
                <td>
                  {{ $artist->name }}
                </td>
                <td>
                  <a class="btn btn-primary" href="{{ url('artist/' . $artist->id) }}">show</a>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
<div>
<nav>
    <ul class="pagination">
        @php
            $currentPage = 1; // Inicializar la variable de la página actual
        @endphp

        @for ($i = 1; $i <= $pages; $i++)
            <li class="page-item @if($i == $currentPage) active @endif">
                <a class="page-link" href="{{ url('paginateartist', ['rowsPerPage' => $rpp, 'page' => $i]) }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
    </ul>
</nav>
</div>
@endsection