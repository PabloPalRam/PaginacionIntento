@extends ('app.base')
@section('title', 'Argo App Settings')

@section ('content')
        <form action="{{ url('setting') }}" method="POST">
       
        @method('put')
        @csrf
       
        
        <div>behaviour after inserting new movie</div>
        <br>
        
        <input type="radio" class="form-check-input" id="showMovie" name="afterInsert" value="show movies" {{ $checkedList }}/>
        <label for="showMovie" class="form-check-label">Show all movies</label>
        <br>
        <input type="radio" class="form-check-input" id="createMovie" name="afterInsert" value="create movie" {{ $checkedCreate }}/>
        <label for="createMovie" class="form-check-label">Show create new movie form</label>
        <br>
        <br>
        
        <label>
            
        <select name="editMovie" id="editMovie" class="form-select" aria-label="Default select example">
        <label for="editMovie">Behaviour after editing movie</label>
            @foreach ($afterEditOptions as $value => $label)
                <option value="{{ $value }}" {{$selectedEditOption == $value ? 'selected': ''}}>{{ $label }}</option>
            @endforeach
        </select>

        <br>
        <button type="submit" class="btn btn-primary">Save Settings</button> 
    </form>
    
@endsection