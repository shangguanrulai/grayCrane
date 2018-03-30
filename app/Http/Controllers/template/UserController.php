<?php

namespace App\Http\Controllers\template;

use App\Model\Admin_User;
use App\Model\user_home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Hash;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$users = Admin_User::paginate(3);
        return view('template.user.list',['users'=>$users]);*/

        /*$gjz = $request -> input('gjz');
        $qx = $request -> input('qx');
		
        $users = Admin_User::where('username','like','%'.$gjz.'%')->where('auth',$qx)->paginate(5);
        return view('template.user.list',['users'=>$users,'gjz'=>$gjz,'qx'=>$qx]);*/
		
        $users = Admin_User::orderBy('id','asc')
            ->where(function($query) use($request){
//                检测关键字
                $gjz = $request -> input('keywords1');
                $qx = $request -> input('keywords2');
//                关键字不为空
                if(!empty($gjz)){
                    $query -> where('username','like','%'.$gjz.'%');


                }
                if(!empty($qx)){
                    $query -> where('auth',$qx);
                }
            })
            ->paginate(3);
        return view('template.user.list',['users'=>$users,'request'=>$request]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template.user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //表单验证
        $this->validate($request, [
            'username' => 'required',
            'userpass' => 'required',
            'reuserpass' => 'required',
            'reuserpass'=>'same:userpass',
            'username' => 'regex:/^\w{6,15}$/'
        ],[
            'username.required'=>'用户名不能为空',
            'userpass.required'=>'密码不能为空',
            'reuserpass.same'=>'两次密码不一致',
            'username.regex' => '用户名格式不正确'
        ]);
        // 接受提交过来的数据
        $input = $request -> except('_token','reuserpass');
        $arr = Admin_User::where('username',$input['username'])->first();
        if($arr){
            return back()->with('error','该用户已存在!');
        }

        //密码加密
        $input['userpass'] = Crypt::encrypt($input['userpass']);
        //保存上传的头像
        $path = $request->profile->store('uploads');
        //保存图片的路径
        $input['profile'] = $path;
//      添加到用户表
        $user = new Admin_User();
        foreach($input as $k => $v){
            $user -> $k = $v;
        }
        $res = $user -> save();

        if($res){
            return redirect('/cate');
        }else{
            return back()->with('msg','添加失败');
        };


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取用户信息
        $user = Admin_User::find($id);
        //导入修改页面
        return view('template.user.edit',compact('user'));


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
        //获取表单提交过来的数据
        $this->validate($request, [
            'username' => 'required',
            'userpass' => 'required',
            'reuserpass' => 'required',
            'reuserpass'=>'same:userpass',
            'username' => 'regex:/^\w{6,15}$/'
        ],[
            'username.required'=>'用户名不能为空',
            'userpass.required'=>'密码不能为空',
            'reuserpass.same'=>'两次密码不一致',
            'username.regex' => '用户名格式不正确'
        ]);
        $input = $request->except('_token','_method','reuserpass');
        $arr = Admin_User::where('username',$input['username'])->first();
        if($arr && $id != $arr['id']){
            return back()->with('error','该用户已存在!');
        }else if($arr && $id==$arr['id']){
            $pass = Crypt::decrypt($arr['userpass']);
            if($input['qrpass']==$pass){
                unset($input['qrpass']);
                $input['userpass'] = Crypt::encrypt($input['userpass']);
                //保存上传的头像
                $path = $request->profile->store('uploads');

                //保存图片的路径
                $input['profile'] = $path;


                $user = Admin_User::find($id);

                foreach($input as $k => $v){
                    $user -> $k = $v;
                }
                $res = $user -> save();

                if($res){
                    return redirect('/user');
                }else{
                    return back()->with('msg','修改失败');
                };

            } else{
                return back()->with('error','原密码不正确!!');
            }
        }







    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Admin_User::find($id);
        $res = $user -> delete();
        if($res){
            return back()->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败');
        }
    }

    public function change(Request $request)
    {

        $uid = $request -> input('id');
//        $status = ($request -> input('status')==1)?0:1;
        if($request -> input('status')==1){
            $status=0;
        }else{
            $status=1;
        }
        $user = Admin_User::find($uid);

       $res = $user -> update(['status' => $status]);

        if($res){
            $arr=[
                'status'=>$status,
                'msg'=>'修改成功'

            ];
        }else{
            $arr=[
                'status'=>$status,
                'msg'=>'修改失败'

            ];
        }
        return $arr;

   }

   public function delall(Request $request){
        $id = $request -> input('id');
        $a = $request -> input('a');
        $user = Admin_User::find($id);

       $res = $user -> delete();


       if($res) {
            $a++;
           $arr = [
                'a'=>$a,
               'msg' => '删除成功'

           ];
       }
       return $arr;

   }
   
}
