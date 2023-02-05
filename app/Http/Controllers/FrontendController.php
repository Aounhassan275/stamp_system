<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\City;
use App\Models\Country;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function chat($id)
    {
        $chat = Chat::find($id);
        if(!$chat->status)
        {
            toastr()->warning('No Active Chat');
            return back();
        }
        ChatMessage::where('chat_id',$chat->id)->whereNotNull('admin_id')->where('status','Unread')->update(['status' => 'Read']);
        return view('front.chat.index',compact('chat'));
    }
    public function chatmessageStore(Request $request)
    {
        ChatMessage::create($request->all());
        return redirect()->back();   
    }
    public function get_latest_chat(Request $request)
    {
        $messages = ChatMessage::where('chat_id',$request->chat_id)->whereNotNull('admin_id')->where('status','Unread')->get();
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
