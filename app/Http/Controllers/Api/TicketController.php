<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Ticket::with('user')->where('user_id',$request->user()->id)->get();

        return response()->json([
            'success'=>true,
            'data'=>$data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // api request valiadtion
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'priority' => 'required',
            'type' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $ticket = Ticket::create([
            'user_id'=>$request->user()->id,
            'subject'=>$request->subject,
            'priority'=>$request->priority,
            'type'=>$request->type,
        ]);

        TicketReply::create([
            'user_id'=>$request->user()->id,
            'ticktet_id'=>$ticket->id,
            'reply'=>$request->message
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'ticket created successfully',
            'data'=>$ticket
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::with('ticketReply')->with('user')->find($id);

        // check if ticket exists
        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'ticket not found'], 404);
        }

        return response()->json([
            'success'=>true,
            'data'=>$ticket
        ],201);

    }

    function reply(Request $request,$id)
    {
        // api request valiadtion
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $ticket = Ticket::with('ticketReply')->with('user')->find($id);

        // check if ticket exists
        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'ticket not found'], 404);
        }

        TicketReply::create([
            'user_id'=>$request->user()->id,
            'ticktet_id'=>$ticket->id,
            'reply'=>$request->message
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'reply submitted successfully',
            'data'=>$ticket
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ticket = Ticket::find($id);

        // check if ticket exists
        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'ticket not found'], 404);
        }

        TicketReply::create([
            'user_id'=>$request->user()->id,
            'ticktet_id'=>$ticket->id,
            'reply'=>$request->message
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'reply submitted successfully',
            'data'=>$ticket
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        // check if ticket exists
        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'ticket not found'], 404);
        }

        $ticket->delete();

        return response()->json([
            'success'=>true,
            'message'=>'ticket deleted successfully'
        ],201);
    }
}
