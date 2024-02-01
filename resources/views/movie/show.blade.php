@extends('app.base')

@section('title', 'Argo Movie')

@section('content')
<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <tbody>
            <tr>
                <td>#</td>
                <td>{{ $movie->id }}</td>
            </tr>
            <tr>
                <td>Title</td>
                <td>{{ $movie->title }}</td>
            </tr>
            <tr>
                <td>Director</td>
                <td>{{ $movie->director }}</td>
            </tr>
            <tr>
                <td>Year</td>
                <td>{{ $movie->year }}</td>
            </tr>
            <tr>
                <td>Genre</td>
                <td>{{ $movie->genre }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection