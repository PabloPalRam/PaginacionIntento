@extends('app.base')

@section('title', 'Argo Artist')

@section('content')
<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <tbody>
            <tr>
                <td>#</td>
                <td>{{ $artist->id }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $artist->name }}</td>
            </tr>
            @foreach($artist->disks as $disk)
            <tr>
                <td>Disk</td>
                <td>Disk title</td>
            </tr>
            @endforeach
            <tr>
                <td>add disk</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('disk/create?idartist=' . $artist->id) }}">show</a>
                </td>
            </tr>
            <tr>
                <td>add disk</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('disk/create/' . $artist->id) }}">show</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection