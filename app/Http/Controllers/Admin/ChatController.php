<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chats = Chat::where('admin_id',Auth::user()->id)->get();
        return view('admin.chat.index',compact('chats'));

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
        $chat = Chat::create($request->all());
        $message = ChatMessage::create([
            'message' => $request->message,
            'chat_id' => $chat->id,
            'admin_id' => Auth::user()->id
        ]);
        toastr()->success('Message Send To User Successfully');
        return redirect()->route('admin.chat.show',$chat->id);  
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chat = Chat::find($id);
        $messages = ChatMessage::where('chat_id',$id)->get();
        foreach($messages as $message)
        {
            if($message->admin_id == null)
            {
                $message->update([
                    'status' => 'Read'
                ]);
            }
        }
        return view('admin.chat.show')->with('chat',$chat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chat = Chat::find($id);
        $chat->delete();
        toastr()->success('Chat Deleted Successfully');
        return redirect()->back();
    }
    public function make_active($id)
    {
        $chat = Chat::find($id);
        $chat->update([
            'status' => 1
        ]);
        toastr()->success('Chat is Active Successfully');
        return back();  
    }
    public function make_inactive($id)
    {
        $chat = Chat::find($id);
        $chat->update([
            'status' => 0
        ]);
        toastr()->success('Chat is Inactive Successfully');
        return back();  
    }
    
    public function chatmessageStore(Request $request)
    {
        ChatMessage::create($request->all());
        return redirect()->back();   
    }
    public function get_latest_chat(Request $request)
    {
        $messages = ChatMessage::where('chat_id',$request->chat_id)->whereNull('admin_id')->where('status','Unread')->get();
        $html = [];
        if($messages)
        {
            $html = view('front.chat.latest_chat', compact('messages'))->render();
        }
        return response()->json([
            'status' => true,
            'html' => $html,
            'messages' => $messages,
        ]);
    }
}
