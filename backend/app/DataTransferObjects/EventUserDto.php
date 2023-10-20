<?php
namespace App\DataTransferObjects;

use Illuminate\Http\Request;

class EventUserDto{
    public function __construct(
        public readonly int $user_id,
        public readonly int $event_id,
    ){}

}
