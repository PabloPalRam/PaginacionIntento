@extends('app.base')

@section('title', 'Argo Disk List')

@section('content')


<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">title</th>
          <th scope="col">idartist</th>
          <th scope="col">Year</th>
          <th scope="col">Cover</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($disks as $disk)
            <tr>
                <td>{{ $disk->id }}</td>
                <td>{{ $disk->title }}</td>
                <td>{{ $disk->idartist }} {{ $disk->artist->name }}</td>
                <td>{{ $disk->year }}</td>
                <td>
                  @if($disk->cover != null)
                  <img src="data:image/jpeg;base64,{{ $disk->cover }}" >
                  @endif
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    <a class="btn-info btn" href="{{ url('disk/create')  }}">add (no sense anymore)</a>
</div>

@endsection

