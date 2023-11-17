<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventsRequest;
use App\Http\Requests\UpdateEventsRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventTreeResource;
use App\Models\Events;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');
        $perPage = request('per_page', 10);
        $search = request('search', '');

        $events = Events::query()
        ->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('percentage', 'like', "%{$search}%");
        })
            ->orderBy('active', 'desc') // Order by active in ascending order
            ->orderBy($sortField, $sortDirection)
            // ->latest()
            ->paginate($perPage);

        return EventResource::collection($events);
    }

    public function getAsTree()
    {
        return Events::getActiveAsTree(EventTreeResource::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventsRequest $request)
    {

        $existingActiveEvent = Events::where('active', 1)->first();
        $data = $request->validated();
        
        if ($existingActiveEvent) {
            // If a record with 'active' equal to 1 exists, return that data
            if($data['active'] == 1){
                return [-1, new EventResource($existingActiveEvent)];
            }
        }

        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;
        $event = Events::create($data);

        return [1,new EventResource($event)];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventsRequest $request, Events $event)
    {

        $existingActiveEvent = Events::where('active', 1)->first();
        $data = $request->validated();
        
        if ($existingActiveEvent) {
            // If a record with 'active' equal to 1 exists, return that data
            if($data['active'] == 1 && $event->id !== $existingActiveEvent->id){
                return [-1, new EventResource($existingActiveEvent)];
            }
        }

        $data['updated_by'] = $request->user()->id;
        $event->update($data);

        return [1, new EventResource($event)];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Events $event)
    {
        $event->delete();

        return response()->noContent();
    }
    
    public function eventWithAll(Events $event)
    {
        $events = Events::select('id', 'name')
            ->get();

        // Add the 'all' and 'All Events' row with both 'id' and 'name'
        $allEvents = new Events();
        $allEvents->id = 0;
        $allEvents->name = 'All Events';

        $events->prepend($allEvents);

        return $events;
    }

}
