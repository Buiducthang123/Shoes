<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{
    //Đăng nhập ----------------------------------------------------
    function login(Request $request)
    {
        $validate = $request->validate(
        [
            'email'=>"required|email",
            'password'=>"required"
        ]
        );
       
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::getUser();

            // Khởi tạo đối tượng Agent
            $agent = new Agent();

            // Lấy thông tin kiểu thiết bị đăng nhập
            $deviceType = $agent->deviceType();
            //Tạo token
            $token = $user->createToken($deviceType)->plainTextToken;
            $user->tokens = $token;
            return response()->json([
                'token' => $token,
                'user' => $user
            ], 200)->cookie(
                    'authToken',
                    $token,
                    60,
                    '/',
                    'http://localhost:5173/',
                    true,
                    true // HttpOnly, secure
                );

        }
        return response()->json(['message' => 'Authentication failed'], 401);
    }
    //------------------------Đăng ký------------------------------
    function register(AuthRequest $authRequest)
    {
        $user = new User();
        $user->fill($authRequest->all());
        $user->password = Hash::make($authRequest['password']);
        $user->save();
        Auth::login($user);
        // Khởi tạo đối tượng Agent
        $agent = new Agent();
        // Lấy thông tin kiểu thiết bị đăng nhập
        $deviceType = $agent->deviceType();
        // Tạo token cho người dùng đăng ký
        $token = $user->createToken($deviceType)->plainTextToken;
        return response()->json([
            'message' => 'Đăng ký thành công',
            'token' => $token,
            'user' => $user
        ], 200)->cookie(
                'authToken',
                $token,
                60,
                '/',
                'http://localhost:5173/',
                true,
                true // HttpOnly, secure
            );
    }


    //--------------------Đăng xuất-----------------------------

    function logout(Request $request)
    {

        $agent = new Agent();
        $deviceType = $agent->deviceType();
        $user = $request->user();

        if ($user) {
            $user->tokens()->where('name', $deviceType)->delete();
            return response()->json(['message' => 'Đăng xuất thành công', "deviceType" => $deviceType], 200);
            // Xoá các mã thông báo liên kết với loại thiết bị hiện tại
        } else {
            // Xử lý trường hợp không có người dùng được xác thực thành công
            return response()->json(['message' => 'Không thể đăng xuất'], 400);

        }
    }


    //---------------Lấy ra user đang đăng nhập-----------------------
    function getCurrentUser(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            return response()->json([
                "user" => $user
            ], 200);
        } else {
            return response()->json([
                "message" => "Unauthorized"
            ], 401);
        }
    }
}