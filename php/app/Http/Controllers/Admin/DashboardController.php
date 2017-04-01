<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media_community;
use App\Models\Message;
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
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::limit(4)->orderBy('id','DESC')->get();
        $news = DB::table('news')->where('user_id','=',Auth::id())->get();


//        dd($news);
        return view('Admin.dashboard.league-agent',['news'=>$this->build_data($news),'messages'=>$messages]);
    }
    public function build_data($news){
        foreach ($news as $new =>$v){
            if($v->release_sta==1){
                $v->release_sta = '已派单';
            }elseif ($v->release_sta==2){
                $v->release_sta = '已提交';
            }elseif ($v->release_sta==3){
                $v->release_sta = '投诉申诉';
            }elseif ($v->release_sta==4){
                $v->release_sta = '已完成';
            }elseif ($v->release_sta==4){
                $v->release_sta = '已拒单';
            }else{
                $v->release_sta = '已流单';
            }
        }
        return $news;
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
    public function getnews(){
        return json_encode(['msg'=>'msg','sta'=>'0','data'=>$this->getNewslist(1)]);
    }

    public function searchNewspage(){
        $start =Input::get('start');
        $end =Input::get('end');
        $title = Input::get('title');
        $data = $this->searchNews($start,$end,$title);
//        dd($data);
        return view('Admin.dashboard.newspage',['data'=>$this->build_data($data)]);
    }
    public function searchNews($start,$end,$title){
        $start = strtotime($start);
        $end = strtotime($end);
        $sql ='select id,order_code,title,news_type,created_at,price,release_sta from news where user_id = '.Auth::id().' AND ';
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

    public function get_news(){
        $type = Input::get('type');
        $start = Input::get('start');
        $end = Input::get('end');
        $page = Input::get('page');
        $keyword = Input::get('keyword');
        $newstype = Input::get('newstype');
        $order = Input::get('order');
    }

    public function get_month_data(){
        return response()->json(['sta'=>'1','data'=>get_month_data(),'msg'=>'gg']);
    }



    public function showMessage(){
        return view('Admin.dashboard.messagepage',['read'=>$this->getMessage(1),'unread'=>$this->getMessage(0)]);
    }

    public function getMessage($type){
        $data = Message::where('receive','=',Auth::id())->where('read','=',$type)->get();
        return $data;
    }

    public function messageDetail(){
        $id = Input::get('id');
        return view('Admin.dashboard.messagedetail',['data'=>$this->getMessageById($id)]);
    }

    public function getMessageById($id){
        $data = Message::find($id);
//        dd($data);
        $data->read();
        $data->save();
        return $data;
    }
}
