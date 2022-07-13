<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Mail;
use Illuminate\Support\Facades\Auth;
use Validator;

class AjaxLoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customer',
            'password' => 'required|password',
        ],[
            'password.required' => 'Mật khẩu không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Email không tồn tại',
            'password.password'=> "Mật khẩu không đúng"
        ]);
        if($validator->passes()) {
            $data = $request->only('email','password');
            $check_login = Auth::guard('cus')->attempt($data, $request->has('remember'));// remember->chọn checkbox thì là true
            if($check_login){
                if (Auth::guard('cus')->user()->status == 0) {
                    Auth::guard('cus')->logout();
                    return response()->json(['error'=>['Tài khoản của bạn chưa xác thực']]);
                }
                return response()->json(['data'=>Auth::guard('cus')->user()]);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function comment($product_id, Request $request)
    {
        $customer_id= Auth::guard('cus')->user()->id;
        $validator = Validator::make($request->all(),[
            'comment' => 'required',
        ],[
            'comment.required' => 'Nội dung bình luận không để trống'
        ]);
        if($validator->passes()) {
            $data = [
                'customer_id' => $customer_id,
                'product_id' => $product_id,
                'comment' => $request->comment,
                'rep_id' => $request->rep_id ? $request->rep_id : 0,
            ];
            if($comment = Comment::create($data)){
                $comments = Comment::where(['product_id' => $product_id, 'rep_id' => 0])->orderBy('id', 'DESC')->get();
                return view('list-comment', compact('comments'));
            }
        }
        return response()->json(['error'=>$validator->errors()->first()]);
    }
}