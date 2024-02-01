<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies=Movie::all(); //eloquent
        //dd($movies);
        return view('movie.index',['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(Request $request)
    {
        //1º generar el objeto para guardar
        $object=new Movie($request-> all());
        //2º intentar guardar
        try{
            //$result=$object->save();
            $movie = Movie::create($request -> all());
            //3º si lo he guardado volver a algún sitio: index, create
            return redirect('movie/create') ->with(['message' => 'The movie has been saved']);
        }catch(\Exception $e){

            //4º si no lo he guardado volver a la página anterior con sus datos para volver a rellenar el formulario
            return back()->withInput()->withErrors(['message' => 'The movie has not been saved.']);
        }

    }
    */
        public function store(Request $request){
        
        //1º generar el objeto para guardar
        
        $object = new Movie($request->all());
        
        //2º intentar guardar
        //dd($object);
        try {
             
            $result = $object->save();  
            //dd($result);
        //3º si lo he guardado volver a algún sitio
            $afterInsert=session('afterInsert','show movies');
            $target='movie';
            if($afterInsert != 'show movies'){
                $target='movie/create';
            }
            return redirect($target)->with(['message'=> 'The movie has been saved.']);
            
        } catch(\Exception $e) {
            
        //4º si no lo he guardado, volver a la pag anterior con los datos para volver a rellenar el formulario
            return back()->withInput()->withErrors(['message' => 'The movie has not been saved.']);
            
        }
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //dd($movie);
        return view('movie.show', ['movie' => $movie]);
    }
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movie.edit', ['movie' => $movie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    /* 
    public function update(Request $request, Movie $movie)
    {
        
        try{
            $result=$movie->update($request->all());
            return redirect('movie')->with(['message' => 'la pelicula ha sido actualizada']);
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['message' => 'la pelicula no ha sido actualizada']);
        }

    }
    */
    public function update(Request $request, Movie $movie)
    {
        
        //1º generar el objeto para guardar
        
        
        try {
            
            $movie->update($request->all());
            $afterEdit=session('afterEdit','movie');
            $target='movie'; //edit/movie/show
            if($afterEdit=='movie'){
                $target='movie';
            }else if($afterEdit=='edit'){
                $target='movie/'.$movie->id .'/edit';
            }else{
                $target='movie/'.$movie->id;
            }
            //3º si lo he guardado volver a algún sitio
            return redirect($target)->with(['message'=> 'The movie has been updated.']);
            
        } catch(\Exception $e) {
            
            //4º si no lo he guardado, volver a la pag anterior con los datos para volver a rellenar el formulario
            return back()->withInput()->withErrors(['message' => 'The movie has not been updated.']);
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        try {
            $movie->delete();
            return redirect('movie')->with(['message' => 'The movie has been deleted.']);
        } catch(\Exception $e) {
             return back()->withErrors(['message' => 'The movie has not been deleted.']);
        }
    }

    function view(Request $request, Movie $id){
        $movie=Movie::find($id);
        if($movie == null){
            return abort(404);
        }
        dd([$id,$movie]);
        
    }
    
       //function view($id){
        
    //}


}
