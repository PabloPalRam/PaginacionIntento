<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    function index(){
        //consultas en eloquent
        $paises1=Pais::all();
        $paises2=Pais::orderBy('name')->get(); //base de datos
        //$paises3NO=Pais::all()->sortBy('name');//código
        $paises3=Pais::where('name','>=','t')->orderBy('name','desc')->take(10)->get(); //el take10 hace que te de los primeros 10 paises
        //$pais=Pais::find('AGO');
        $pais=Pais::where('name','>=','t')->orderBy('name','desc')->first();
        //dd($paises3);
        //dd([$paises1, $paises2]);
        
        
        //consultas en db
        $paises0=Pais::where('name','>=','t')->get();
        $paises1=DB::select('select * from pais where name >= :name', ['name' => 't']);
        foreach($paises0 as $pais){
            echo $pais->name . ' ' . get_class($pais) .'<br>';
        }
        echo '<hr>';
        foreach($paises1 as $pais){
            echo $pais->name . ' ' . get_class($pais) .'<br>';
        }
        //dd($paises1);
        
        $paises2=DB::table('pais')->get();
        //$pais1=DB::table('pais')->find('AGO');
        $pais2=DB::table('pais')->where('name','>','t')->first();
        //dd([$pais2, $paises2]);
        
        
        //consultas en pdo
        $pdo=DB::connection()->getPdo();
        //sentencia preparada
        $sql="select * from pais where code = :code";
        //preparo
        $sentencia=$pdo->prepare($sql);
        //asocio valores
        $sentencia->bindValue('code','AGO');
        //ejecuto
        $sentencia->execute();
        //cursor, $sentencia
        foreach($sentencia as $fila){
            echo '<pre>' . var_export($fila, true) . '</pre>';
        }
        
         $sql="select * from pais";
         $sentencia=$pdo->prepare($sql);
         //$sentencia->bindValue('','');
         $sentencia->execute();
         $paises=[];
          foreach($sentencia as $fila){
            //echo '<pre>' . var_export($fila, true) . '</pre>';
            $pais=new Pais($fila);
            $paises[]=$pais;
        }
         //echo '<pre>' . var_export($paises, true) . '</pre>';
         dd($paises);
         
    }
}
