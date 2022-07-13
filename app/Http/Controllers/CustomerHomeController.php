<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Str;
use Mail;

class CustomerHomeController extends Controller
{
    public function register()
    {
        return view('customer.register');
    }

    public function login()
    {
        return view('customer.login');
    }

    public function post_register(Request $request)
    {
        $request->validate(
            [
            'name' => 'required',
            'email' =>'required|email|unique:customer',
            'password' =>'required',
            'confirm_password' =>'required|same:password',
            'phone' =>'required',
            'address' =>'required'
            ],
        );
        $data = $request->only('name', 'email', 'password', 'phone', 'address');
        $token = strtoupper(Str::random(20));
        $passhashed = bcrypt($request->password);
        $data['password'] = $passhashed;
        $data['token'] = $token;
        if($customer=Customer::create($data)){
            Mail::send('email.active_account',compact('customer'),
            function($email) use ($customer){
                $email->subject('My shop - Xác nhận tài khoản');
                $email->to($customer->email, $customer->name );
            });
            return redirect()->route('customer.login')->with('success', 'Đăng ký thành công, vui lòng xác nhận tài khoản qua mail của bạn');
        }
        return redirect()->back()->with('error', 'Đăng ký không thành công');
    }   

    public function post_login(Request $request)
    {
        $request->validate(
            [
            'email' =>'required|email|exists:customer',
            'password' =>'required',
            ],[
                'password.required' => 'Mật khẩu không được để trống',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.exists' => 'Email không tồn tại',
            ],
        );
        $data = $request->only('email','password');
        $check_login = Auth::guard('cus')->attempt($data, $request->has('remember'));// remember->chọn checkbox thì là true
        if($check_login){
            if (Auth::guard('cus')->user()->status == 0) {
                Auth::guard('cus')->logout();
                return redirect()->route('customer.login')->with('error', 'Tài khoản của bạn chưa được kích hoạt, vui lòng vào email của bạn để kích hoạt');
            }
            return redirect()->route('home.index');
        }
        return redirect()->back()->with('error','Mật khẩu không đúng');
    }

    public function logout()
    {
        Auth::guard('cus')->logout();

        return redirect()->route('home.index');
    }

    public function profile()
    {
        return view('customer.profile');
    }

    public function changepasswordform()
    {
        return view('customer.changepassword');
    }

    public function changepassword(Request  $request)
    {
        if (!(Hash::check($request->get('old_password'), Auth::guard('cus')->user()->password))) {
            return back()->with('error', 'Your current password does not match with what you provided');
        }
        if (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
            return back()->with('error', 'Your current password does not match with the new password');
        }
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        $user = Auth::guard('cus')->user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect()->route('home.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Auth::guard('cus')->user();
        $customer = Customer::find($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->update();
        return redirect()->route('customer.profile');
    }

    public function actived(Customer $customer, $token)
    {
        if($customer->token === $token){
            $customer->update(['status'=> 1 ]);
            return redirect()->route('customer.login')->with('success', 'Xác nhận tài khoản thành công, bạn có thể đăng nhập');
        }else{
            return redirect()->route('customer.login')->with('error', 'Mã xác nhận không hợp lệ');
        }
    }

    public function forgetPass()
    {
        return view('customer.forgetPass');
    }

    public function post_forgetPass(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:customer'
        ],[
            'email.required' => 'Vui lòng nhập địa chỉ email hợp lệ',
            'email.exists' => 'Email này không tồn tại trong hệ thống'
        ]);

        $token = strtoupper(Str::random(20));
        $customer = Customer::Where('email', $request->email)->first();
        $customer ->update(['token' => $token]);
        Mail::send('email.check_email_forget',compact('customer'),
        function($email) use ($customer){
            $email->subject('My shop - Lấy lại mật khẩu');
            $email->to($customer->email, $customer->name );
        });
        return redirect()->route('customer.login')->with('success', 'Vui lòng check email để thực hiện thay đổi mật khẩu');
    }

    public function getPass(Customer $customer, $token)
    {
        if($customer->token === $token){
            return view('customer.getPass');
        }
        return abort(404);
    }

    public function post_getPass(Customer $customer, $token, Request $request)
    {
        $request->validate([
            'password'=>'required',
            'confirm_password' =>'required|same:password',
        ]);
        $passhashed = bcrypt($request->password);
        $customer->update(['password'=> $passhashed, 'token'=> null]);
        return redirect()->route('customer.login')->with('success','Đặt lại mật khẩu thành công, vui lòng đăng nhập');
    }

    public function rating(Request $request)
    {
        // dd($request->all());
        $model = Rating::where($request->only('product_id','customer_id'))->first();
        if($model){
            Rating::where($request->only('product_id','customer_id'))->update($request->only('rating_start'));
        }else{
            Rating::create($request->only('rating_start', 'product_id','customer_id'));
        }
        return redirect()->back();
    }
}