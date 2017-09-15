<?php

namespace App\Http\Controllers;

use App\Repositories\CarRepository;

use Cookie;
use Response;
use Crypt;

class CarsController extends Controller
{
    protected $carRepository;

    public function __construct(CarRepository $carRepository){
        $this->carRepository=$carRepository;
    }

    public function getMarks(){
        $response['marks']=$this->carRepository->getMarks();
        return response()->json($response);
    }

    public function getModels($mark){
        $response['models']=$this->carRepository->getModels($mark);

        return response()->json($response);
    }

    public function getYears($mark=false,$model=false){

        $response['years']=$this->carRepository->getYears($mark,$model);

        return response()->json($response);
    }

    public function getCars($mark=false,$model=false,$from=false,$to=false){

        $where=false;

        if($mark){$where[]=['name','like','%'.$mark.'%'];}
        if($model){$where[]=['name','like','%'.$model.'%'];}
        if($from){$where[]=['year','>=',$from];}
        if($to){$where[]=['year','<=',$to];}

        $orderBy = array('col'=>'createdAt','sortDir'=>'desc');

        if($to||$from){
            $orderBy=[];
            $orderBy['col']='year';
            $orderBy['sortDir']='asc';
        }


        $cars=$this->carRepository
            ->get(['*'],false,config('settings.cars_on_page'),$where,$orderBy);


        return view(env('THEME').'.indexContent')->with('cars',$cars)->render();
    }

    public function addFavoriteCars(){

    }
    public function getFavoriteCars(){
//
//
//        $where=false;
//
//        $where[]=['name','like','%'.$mark.'%'];
//
//        $orderBy = array('col'=>'createdAt','sortDir'=>'desc');
//
//        if($to||$from){
//            $orderBy=[];
//            $orderBy['col']='year';
//            $orderBy['sortDir']='asc';
//        }
//
//
//        $cars=$this->carRepository
//            ->get(['*'],false,config('settings.cars_on_page'),$where,$orderBy);
//
//
//        return view(env('THEME').'.indexContent')->with('cars',$cars)->render();
//
//        $cars=['124','3434','6565'];
//
//        setcookie('cookie', json_encode($cars), time()+3600);
//        //$cookie = Cookie::forever('favoriteCars',json_encode($cars),'','');
//
//
//        //$response = Response::make('Hello World');
//
//        return 'qw';

    }
}
