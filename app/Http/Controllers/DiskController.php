<?php

namespace App\Http\Controllers;

use App\Models\Disk;
use App\Models\Artist;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DiskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disks = Disk::all();
        return view('disk.index',['disks'=> $disks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $idartist = $request->idartist;
        return $this->createArtist($request, $idartist);
        
    }


    function createArtist(Request $request, $idartist){
        
        if($idartist ==null){
            return back();
        }
        $artist=Artist::find($idartist);
        if($artist ==null){
            return back();
        }
        
        $artists=Artist::pluck('name','id');
        return view('disk.create',['artist' => $artist,
                                    'artists' => $artists,
                                    'idartist' => $idartist]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $disk=new Disk($request-> all());
            if($request->hasFile('file') && $request->file('file')->isValid()) {
            $archivo = $request->file('file');
            //crea la carpeta
            $path = $archivo->storeAs('public/images', $archivo->getClientOriginalName());
            $mime=$archivo->getMimeType();
            //condicion mime
            $path = $archivo->getRealPath();
            //Image::make($path)->resize();
            $image = Image::make($path)->resize(245,245,function($constraint){
                $constraint->aspectRatio();
            });
            $canvas=Image::canvas(245,245);
            $canvas->insert($image,'center');
            //$image->save('temporal'); //public
            $canvas->save($path);
            $imagen = file_get_contents($path);
            $disk->cover = base64_encode($imagen);
            
            }
             $disk->save();
        } catch(\Exception $e) {
            
        //4º si no lo he guardado, volver a la pag anterior con los datos para volver a rellenar el formulario
            return back()->withInput()->withErrors(['message' => 'The disk has not been saved.']);
            
        }
        
        return redirect('disk')->with(['message' => 'the disk has been saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disk  $disk
     * @return \Illuminate\Http\Response
     */
    public function show(Disk $disk)
    {
        return view('disk.show', ['disk' => $disk]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disk  $disk
     * @return \Illuminate\Http\Response
     */
    public function edit(Disk $disk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disk  $disk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disk $disk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disk  $disk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disk $disk)
    {
        //
    }
    
    public function view(){
        return response()->file(storage_path('app') . '/public/images/faces.png'); //poner el nombre de mi imagen    
    }
    
    
}
