<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'eventId'=>$this->id,
            'eventName'=>$this->name,
            'eventDescription'=>$this->description,
            'startDateTime'=>$this->start_time,
            'endDateTime'=>$this->end_time,
            'createdBy'=>$this->user_id,
            'userDetails'=>new UserResource($this->whenLoaded('user')),
            'eventAttendees'=> AttendeeResource::collection($this->whenLoaded('attendees'))
        ];
        //return parent::toArray($request);
    }
}
