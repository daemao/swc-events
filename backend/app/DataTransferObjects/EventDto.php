<?php
namespace App\DataTransferObjects;

use Illuminate\Http\Request;

class EventDto{
    public function __construct(
        public readonly  string $name,
        public readonly string $body,
        public readonly string $date,
        public readonly int $author_id
    ){}
    public static function fromRequest( Request $request){
        return new self(
            name: $request->validated('name'),
            body: $request->validated('body'),
            date: $request->validated('date'),
            author_id: $request->user()->id,

        );
    }
}
