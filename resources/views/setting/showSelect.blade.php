@extends('app.base')

@section('title', 'Argo Movie List')

@section('content')

<!-- Crear 3 select  -->
<select name="pais" id="pais" class="form-select"  >
    <option hidden select value="">Selecciona el pais</option>
    @foreach ($paises as $value => $label)
        <option value="{{ $value }}" {{ $pais ==$value ? 'selected' : '' }} >{{ $label }}</option>
    @endforeach
    
</select>
<br>
<select name="provincia" id="provincia" class="form-select"  >
    <option disabled value ="" {{ $provincia == '' ? 'selected' :''}}>Selecciona la provincia</option>
    @foreach ($provincias as $value => $label)
        <option value="{{ $value }}" {{$provincia == $value ? 'selected' : ''}}>{{ $label }}</option>
    @endforeach
   
</select>
<br>
<select name="country" id="country" class="form-select"  >
    <option disabled value="" {{$selectedCountry =='' ? 'selected' : ''}}>Selecciona el country</option>
    @foreach ($countries as $country)
        <option value="{{ $country->code }}" {{$selectedCountry>{{ $country->name}}</option>
    @endforeach
    
</select>
<br>
<select name="country" id="country" class="form-select"  >
    <option disabled value="" {{$selectedCountry =='' ? 'selected' : ''}}>Selecciona el country</option>
    @foreach ($countries as $country)
        <option value="{{ $country->code }}" {{$selectedCountry>{{ $country->name}}</option>
    @endforeach
    
</select>
<br>
@endsection        
        
