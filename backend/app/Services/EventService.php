<?php
namespace App\Services;
use App\DataTransferObjects\EventDto;
use App\Models\Event;
use App\Models\User;

class EventService
{
    public function store(EventDto $dto): Event
    {
        return Event::create([
            'name' => $dto->name,
            'body' => $dto->body,
            'author_id' => $dto->author_id,
            'date' => $dto->date
        ]);
    }

    public function update(Event $bank, EventDto $dto): Event
    {
        return tap($bank)->update([
            'name' => $dto->name,
            'body' => $dto->body,
            'date' => $dto->date
        ]);
    }

    public function attachUser(Event $event, User $user)
    {
        return $event->users()->attach($user->id);
    }

    public function detachUser(Event $event, User $user)
    {
        return $event->users()->detach($user->id);
    }
    public function getIfUserCanUpdateEvent(Event $event, User $user)
    {
        return $event->author_id === $user->id || $user->can('can_update_events');
    }
    public function getIfUserCanSubscribeEvent(Event $event, User $user)
    {
        return !$event->users->where('id', $user->id)->first();
    }

    public function getIfUserCanUnsubscribeEvent(Event $event, User $user)
    {
        return !!$event->users->where('id', $user->id)->first();
    }

    public function getIfUserCanDeleteEvent(Event $event, User $user)
    {
        return $event->author_id === $user->id || $user->can('can_delete_events');
    }

    public function getIfUserCanReadUsers(Event $event, User $user)
    {
        return $event->author_id === $user->id || $user->can('can_read_users');
    }
}
