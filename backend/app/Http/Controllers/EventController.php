<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\EventDto;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;
use App\Services\ResourcePaginatorService;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(protected EventService $service){}

    public function create(EventRequest $request){
        $event = $this->service->store(EventDto::fromRequest($request));
        return ResponseService::generateResponse($event);
    }
    public function update(EventRequest $request, Event $event){
        if(!$this->service->getIfUserCanUpdateEvent($event,$request->user())){
            return response (ResponseService::generateResponse(null,'cant_delete_event'),403);
        }
        $event = $this->service->update($event, EventDto::fromRequest($request));
        return ResponseService::generateResponse($event);
    }
    public function item($id){
        $event = Event::with(['users','author'])->find($id);
        return ResponseService::generateResponse(EventResource::make($event));
    }
    public function list(Request $request){
        $data = Event::orderByDesc('id')->get();
        return ResponseService::generateResponse(EventResource::collection($data));
    }
    public function destroy(Event $event,Request $request){
        if(!$this->service->getIfUserCanDeleteEvent($event,$request->user())){
            return response (ResponseService::generateResponse(null,'cant_delete_event'),403);
        }
        try{
            $event->deleteOrFail();
            return ResponseService::generateResponse('ok');
        }catch (\Exception $x){
            return ResponseService::generateResponse(null,$x->getMessage());
        }

    }
    public function subscribe(Event $event,Request $request){
        if(!$this->service->getIfUserCanSubscribeEvent($event,$request->user())){
            return response (ResponseService::generateResponse(null,'cant_subscribe'),403);
        }
        $this->service->attachUser($event,$request->user());
        return ResponseService::generateResponse('success');
    }
    public function unsubscribe(Event $event,Request $request){
        if(!$this->service->getIfUserCanUnsubscribeEvent($event,$request->user())){
            return response (ResponseService::generateResponse(null,'cant_unsubscribe'),403);
        }
        $this->service->detachUser($event,$request->user());
        return ResponseService::generateResponse('success');
    }
}
