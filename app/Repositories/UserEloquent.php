<?php

namespace App\Repositories;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\UserResource;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UserEloquent extends BaseController
{

    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return $this->sendResponse('successfully Register the user', new UserResource($user));
    }

    public function login()
    {
        $proxy = Request::create('oauth/token', 'POST');
        $response = Route::dispatch($proxy);
        $statusCode = $response->getStatusCode();
        $response = json_decode($response->getContent());
        //dd($response);
        if ($statusCode != 200)
            return $this->sendError($response->message);
        $response_token = $response;
        $token = $response->access_token;
        \request()->headers->set('Authorization', 'Bearer ' . $token);
        $proxy = Request::create('api/auth', 'GET');
        $response = Route::dispatch($proxy);
        // dd($response);
        $statusCode = $response->getStatusCode();
        //dd(json_decode($response->getContent()));
        // dd($response->getContent());
        $user = json_decode($response->getContent())->item;

        return $this->sendResponse('Successfully Login', ['token' => $response_token, 'user' => $user]);
    }


    public function getAuthUser()
    {
        $user = auth()->user();
        return $this->sendResponse('user info', new UserResource($user));
    }
}
