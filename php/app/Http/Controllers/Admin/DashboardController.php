<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Redirect;
use Response;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $page =  ceil(count(Db::table('news')->get())/6);
        return view('Admin.dashboard.league-agent',['news'=>DB::table('news')->get()]);
    }


    /**
     * @param $page
     */
    public function getNewslist($page){
        $rev = '6';
        $offset = ($page-1)*$rev;
        $data = Db::select("select id,order_code,title,news_type,created_at,price,status from news limit $offset,$rev");
        return $data;
    }
    public function getNewspage(){
        $page = Input::get('page');

        $page = empty($page)?1:$page;
        $data = $this->getNewslist($page);
        return view('Admin.dashboard.newspage',['data'=>$data]);
    }

    public function searchNewspage(){
        $start =Input::get('start');
        $end =Input::get('end');
        $title = Input::get('title');
        $data = $this->searchNews($start,$end,$title);
        return view('Admin.dashboard.newspage',['data'=>$data]);
    }
    public function searchNews($start,$end,$title){
        $start = strtotime($start);
        $end = strtotime($end);
        $sql ='select id,order_code,title,news_type,created_at,price,status from news where ';
        if($start==false||$end==false){
            if(empty($title)){
                $sql .= '1';
            }else{
                $sql .= " title like '%".$title."%'";
            }
        }else{
            if(empty($title)){
                $sql .= '1';
            }else{
                $sql .= 'start_time BETWEEN '.$start .' AND '.$end." AND title like '%".$title."%'";
            }
        }
        return DB::select($sql);
    }



}
