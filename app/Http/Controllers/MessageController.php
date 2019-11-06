<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class MessageController extends Controller
{
    public function fetchMessages(){
        // $messages = Redis::get('messages.all');
        // if ($messages = Redis::get('messages.all')) {
        //     return json_decode($messages);
        // }

        return Message::get()->load('user');
        // Redis::set('messages.all', $messages);

        // return $message;
    }

    public function privateMessages(User $user)
    {
        $privateCommunication= Message::with('user')
        ->where(['user_id'=> auth()->id(), 'receiver_id'=> $user->id])
        ->orWhere(function($query) use($user){
            $query->where(['user_id' => $user->id, 'receiver_id' => auth()->id()]);
        })
        ->get();
        return $privateCommunication;
    }

    public function sendMessages(Request $request){
        $message = auth()->user()->messages()->create(['message' => $request->message]);
        broadcast(new MessageSent(auth()->user(), $message->load('user')))->toOthers();

        return response(['status'=>'Message Sent Successfully', 'message' => $message]);
    }

    public function sendPrivateMessage(Request $request,User $user)
    {
        $input=$request->all();
        $input['receiver_id']=$user->id;
        $message=auth()->user()->messages()->create($input);
        // if(request()->has('file')){
        //     $filename = request('file')->store('chat');
        //     $message=Message::create([
        //         'user_id' => request()->user()->id,
        //         'image' => $filename,
        //         'receiver_id' => $user->id
        //     ]);
        // }else{
        //     $input=$request->all();
        //     $input['receiver_id']=$user->id;
        //     $message=auth()->user()->messages()->create($input);
        // }
        broadcast(new MessageSent($message->load('user')))->toOthers();
        
        return response(['status'=>'Message private sent successfully','message'=>$message]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
