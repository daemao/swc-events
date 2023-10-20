<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\EventDto;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\UserResouce;
use App\Models\Event;
use App\Models\User;
use App\Services\EventService;
use App\Services\ResourcePaginatorService;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request){
        if(!$request->user()->can('can_read_users')){
            return response (ResponseService::generateResponse(null,'cant_read_users'),403);
        }
        $data = User::orderByDesc('id')->get();
        return ResponseService::generateResponse(UserResouce::collection($data));
    }
}
