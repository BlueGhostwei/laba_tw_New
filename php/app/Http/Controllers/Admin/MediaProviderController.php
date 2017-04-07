<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media_community;
use App\Models\Message;
use App\Models\News;
use App\Models\User;
use App\Models\Wealthlog;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class MediaProviderController extends Controller
{
    public function index(){

    }

    public function create(){

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function order_details($id){
        //查询news表
      $result=News::find($id);

          if($result->release_sta==1){
              $result->release =  '已派单';
          }elseif($result->release_sta==2){
              $result->release =  '已提交';
          }elseif($result->release_sta==3){
              $result->release =  '反馈';
          }elseif($result->release_sta==4){
              $result->release =  '已完成';
          }elseif($result->release_sta==5){
              $result->release =  '已拒单';
          }elseif($result->release_sta==6){
              $result->release =  '已流单';
          }
      if($result->quality==1){
          $result->qualitytext =  '优';
      }elseif ($result->quality==2){
          $result->qualitytext =  '良';
      }else{
          $result->qualitytext =  '差';
      }
      return view('Admin.order.details',['news_data'=>$result]);
    }

    /**
     *判断用户角色，修改相应得数据状态，发送消息队列
     */
    public function  Save_Feedback(Request $request){
        dd($request->all());



    }

    /**
     * @return string
     * 发送系统提示消息
     */
    public function save()
    {
        return $this->validatesRequestErrorBag;
    }

    /**
     * @return mixed
     * //媒体供应商订单列表
     */
    public function Event_list(){
        //查询用户所属媒体
       $Media=Media_community::find(Auth::user()->media_id);
//       dd($Media);
       $media_id=$Media->id;
            //查询媒体未处理订单
//            $result=DB::select("SELECT id,start_time,end_time,order_code,media_id,news_type,title,price FROM news WHERE  instr(concat(',',media_id,','),',$media_id,')<>0 AND status = 2 ORDER BY id DESC ;");
//        $result = DB::select('SELECT id,start_time,end_time,order_code,release_sta,media_id,news_type,title,price FROM news WHERE media_id = '.$media_id.' AND status = 2 ORDER BY id DESC');
        $result = $this->get_event_list();
        if(is_array($result)){

            $state1 = array_filter($result,function($elem){
                if($elem->release_sta==1){
                    return $elem;
                }
            });
            $state2 = array_filter($result,function($elem){
                if($elem->release_sta==2){
                    return $elem;
                }
            });
            $state3 = array_filter($result,function($elem){
                if($elem->release_sta==3){
                    return $elem;
                }
            });
            $state4 = array_filter($result,function($elem){
                if($elem->release_sta==4){
                    return $elem;
                }
            });
            $state5 = array_filter($result,function($elem){
                if($elem->release_sta==5){
                    return $elem;
                }
            });
            $state6 = array_filter($result,function($elem){
                if($elem->release_sta==6){
                    return $elem;
                }
            });
        }
//        dd($result);
      return view('Admin.vider.event_list',['result'=>$result,'list1'=>$state1,'list2'=>$state2,'list3'=>$state3,'list4'=>$state4,'list5'=>$state5,'list6'=>$state6]);
    }

    public function get_event_list(){
        $start = Input::get('start');
        $end = Input::get('end');
        $title = Input::get('title');
        $type = Input::get('type');
        $Media=Media_community::find(Auth::user()->media_id);
//       dd($Media);
        $media_id=$Media->id;
        if(empty($start)&&empty($end)&&empty($type)&&empty($title)){
            $result = DB::select('SELECT id,quality,start_time,end_time,order_code,release_sta,media_id,news_type,title,price FROM news WHERE media_id = '.$media_id.' AND status = 2 ORDER BY id DESC');
        }else{
            $db = DB::table('news')->select(['id','quality','start_time','end_time','order_code','release_sta','media_id','news_type','title','price']);
            if(!empty($start)&&!empty($end)){
                $db->whereBetween('start_time',strtotime($start),strtotime($end));
            }
            if(!empty($title)){
                $db->where('title','like','%'.$title.'%');
            }
            $result = $db->get()->toArray();
        }
        return $result;
    }


    public function customer_feedback(){
        $feedback = empty(Input::get('feedback'))?'':Input::get('feedback');
        $id = Input::get('id');
        $quality = Input::get('quality');
        $news = News::where('id','=',$id)->first();
        if($news->user_id != Auth::id()){
            return response()->json(['msg'=>'没有操作权限！','sta'=>'1','data'=>'']);
        }else{
            $news->cfeedback = $feedback;
            $news->quality =$quality;
            $message['title']='新闻状态更新';
            $message['receive'] =$news->user_id;
            $message['message'] = '你于'.$news->created_at.'向'.Media_community::where(['id'=>$news->media_id])->pluck('media_name')->first().'提交的新闻有了新的状态，请前往'.url('Admin/order/details/').$id.'查看 。';
            $rst1 = Message::create($message);
            if($news->save()){
                return response()->json(['msg'=>'更新成功！','sta'=>'0','data'=>'']);
            }else{
                return response()->json(['msg'=>'更新失败！','sta'=>'1','data'=>'']);
            }
        }
    }

    public function get_list(){
        $type = empty(Input::get('type'))?1:Input::get('type');
        return DB::table('news')->where('release_sta','=',$type)->where('user_id','=',Auth::id())->where('status','=','2')->get();
    }

    public function get_list_api(){
        if (empty($this->get_list())){
            return response()->json(['sta'=>'1','msg'=>'没有查询到数据']);
        }else{
            return response()->json(['sta'=>'0','data'=>$this->get_list(),'msg'=>'gg']);
        }
    }

    public function provider_feedback(){
        $feedback = Input::get('feedback');
        $url = Input::get('url');
        $id = Input::get('id');
        $news = News::where('id','=',$id)->first();
        $user = Auth::user();
        $pic  = Input::get('img');
        $state = Input::get('state');
        if($news->media_id!=$user->media_id){
            return response()->json(['sta'=>'1','msg'=>'无权修改!','data'=>'']);
        }else{
            $news->ofeedback = $feedback;
            $news->f_url = $url;
            $news->release_sta = $state;
            $news->picurl = $pic;
            if ($news->save()){
                if($state == 5){
                    $message['title'] = '新闻发布失败';
                    $message['receive'] =$news->user_id;
                    $message['message'] = '你于'.$news->created_at.'向'.Media_community::where(['id'=>$news->media_id])->pluck('media_name')->first().'提交的新闻发布失败，原因是：'.$feedback.' 。';
                    $rst1 = Message::create($message);
                }else{
                    $message['title'] = '新闻发布状态修改';
                    $message['receive'] =$news->user_id;
                    $message['message'] = '你于'.$news->created_at.'向'.Media_community::where(['id'=>$news->media_id])->pluck('media_name')->first().'提交的新闻有了新的状态，请前往'.url('Admin/order/details/').$id.'"查看 。';
                    $rst1 = Message::create($message);
                }
                return response()->json(['sta'=>'0','msg'=>'操作成功！','data'=>'']);
            }else{
                return response()->json(['sta'=>'1','msg'=>'操作失败！','data'=>'']);
            }
        }
    }

    public function customer_confirm(){
        $id = Input::get('id');
        $news = News::where('id','=',$id)->first();
        $user = Auth::user();
        $quality = Input::get('quality');
//        dd($news);
        if (in_array(null,Input::all())){
            return response()->json(['msg'=>'参数错误！','sta'=>'1','data'=>'']);
            exit();
        }
        if ($news->user_id!=$user->id){
            return response()->json(['msg'=>'无权操作！','sta'=>'1','data'=>'']);
        }else{
            $message['title']='订单完成';
            $message['receive']=Auth::id();
            $message['message'] = '你订单号'.$news->order_code.'为的新闻已完成，订单金额我们将会从你的余额中扣除！';
            $message1['title']='订单完成';
            $message1['receive'] = User::where('media_id','=',$news->media_id)->pluck('id')->first();
            $message1['message'] ='订单号为'.$news->order_code.'的订单用户已确认完成。';
            $news->release_sta = 4;
            $news->quality = $quality;
            if($news->save()){
                try{
                    $rst = Message::create($message);
                    $rst2 = Message::create($message1);
                    Wealthlog::where('order_code','=',$news->order_code)->update(['state'=>'1']);
                    if($user->wealth<$news->price){
                        return response()->json(['msg'=>'余额不足！','sta'=>'1','data'=>'']);
                    }else{
                        $dbbool = DB::transaction(function ()use ($news){
                            $wealth = DB::table('user')->where('id','=',$news->user_id)->pluck('wealth')->first();
                            $p2=$wealth-$news->price;
                            DB::table('user')->where('id','=',$news->user_id)->update(['wealth'=>$p2]);
                            $id = DB::table('user')->where('media_id','=',$news->media_id)->pluck('id')->first();
                            $wealth2 = DB::table('user')->where('id','=',$id)->pluck('wealth')->first();
                            $p=$wealth2+$news->price;
                            DB::table('user')->where('id','=',$id)->update(['wealth'=>$p]);
                            return 1;
                        });
                            if($dbbool){
                                return response()->json(['msg'=>'操作成功，订单金额将会在你的余额中扣除！','sta'=>'0','data'=>'']);
                            }else{
                                return response()->json(['msg'=>'数据库操作失败！','sta'=>'1','data'=>'']);
                            }
                    }
                }catch (\Exception $e){
                    return response()->json(['msg'=>'数据库操作出错！','data'=>'','sta'=>'1']);
                }
            }

        }
    }



    /**
     * @return mixed
     */
    public function user_center(){
        return view('Admin.vider.user_index');
    }

    public function Bill_query()
    {
        return view('Admin.vider.bll_query');
    }
}
