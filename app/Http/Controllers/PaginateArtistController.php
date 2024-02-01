<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PaginateArtistController extends Controller
{
    private $bladefolder='paginateartist';
    const RPP=10;
    const ORDERBY='name';
    const ORDERTYPE='asc';
    
    private function getBladeFolder(string $folder){
        return $this->bladefolder. '.'.$folder;
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rpp=self::getFromRequest($request,'rowsPerPage',self::RPP);
        $orderby=self::getFromRequest($request, 'orderBy',self::ORDERBY);
        $orderType=self::getFromRequest($request, 'orderType', self::ORDERTYPE);
        $q=self::getFromRequest($request, 'q', null);
        if($q == null){
            $artists = Artist::orderBy($orderby,$orderType)->orderBy('name','asc')->paginate($rpp);
        }else{
          $artists = Artist::where('name','like', '%' . $q . '%')
                ->orWhere('id',$q)
                ->orWhere('idOtro', 'like' ,'%' .$q . '%')
                ->orWhere('idArgo', 'like' ,'%' .$q . '%')
                ->orderBy($orderby,$orderType)
                ->orderBy('name','asc')
                ->paginate($rpp);  
        }
        //$artists = Artist::where('id','>',2)->orderBy($orderby,$orderType)->orderBy('name','asc')->paginate($rpp);
        
        //$artists = Artist::paginate($rpp);
        return view($this->getBladeFolder('index'),
            [
                'artists' => $artists,
                'orderBy' => $orderby,
                'orderType' => $orderType,
                'q' => $q,
                'rpp' => $rpp,
                'rpps' => self::getRowsPerPage()
            ]);
    }
    
    public function indexClase(Request $request){
        
    }
    
    private static function getFromRequest($request ,$name, $defaultValue){
        $value=$defaultValue;
        if($request->$name != null) {
            $value = $request->$name;
        }
        
        
        return $value;
    }
    
    /*function index2 (Request $request){
        //1º
        $rpp=self::RPP;
        if($request->rowsPerPage != null) {
            $rpp = $request->rowsPerPage;

        }
        
        //2º
        $page=1;

        if($request->page != null) {
            $page=$request->page;
        }
        
        //3º

        $calculo=$rpp * ($page -1);
        $sql="select * from artist limit $calculo, $rpp";
        $artists=DB::select($sql);
        $total=DB::table('artist')->count();
        $pages =ceil($total/$rpp);
        
        
        return view($this->getBladeFolder('index2'),
            [
                'artists' => $artists,
                'pages' => $pages,
                'rpp' => $rpp,
                'rpps' => self::getRowsPerPage()
            ]);
        
    }
    */
    
    function index2(Request $request) {
        // 1º
        $rpp = self::RPP;
        if ($request->has('rowsPerPage') && is_numeric($request->rowsPerPage)) {
            $rpp = max(1, (int) $request->rowsPerPage); // Asegurarse de que $rpp sea al menos 1
        }
    
        // 2º
        $page = (int) $request->input('page', 1);
    
        // 3º
        $calculo = $rpp * max(0, ($page - 1)); // Asegurarse de que no haya números negativos
        $sql = "SELECT * FROM artist LIMIT $calculo, $rpp";
        $artists = DB::select($sql);
        $total = DB::table('artist')->count();
    
        // Asegurarse de que $rpp sea al menos 1 para evitar division by zero
        $rpp = max(1, $rpp);
    
        $pages = ceil($total / $rpp);
    
        return view($this->getBladeFolder('index2'), [
            'artists' => $artists,
            'pages' => $pages,
            'rpp' => $rpp,
            'rpps' => self::getRowsPerPage(),
            'page' => $page, // Asegurarse de incluir $page en la vista
        ]);
    }

    
    
    
    private static function getRowsPerPage(){
        return[
            3 =>3,
            10 => 10,
            25 => 25,
            50 => 50
        ]; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
