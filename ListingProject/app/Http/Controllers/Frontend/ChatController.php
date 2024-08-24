<?php

namespace App\Http\Controllers\Frontend;

use App\Events\Message;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(): View
    {
        $senderId = auth()->user()->id;

        $receivers = Chat::with(['receiverProfile', 'listingProfile'])
            ->select(['receiver_id', 'listing_id'])
            ->where('sender_id', $senderId)
            ->where('receiver_id', '!=', $senderId)
            ->selectRaw('MAX(created_at) as latest_message_send')
            ->groupBy('receiver_id', 'listing_id')
            ->orderByDesc('latest_message_send')
            ->get();

        return view('frontend.dashboard.message.index', compact('receivers'));
    }

    public function sendMessage(Request $request): Response
    {
        $request->validate([
            'receiver_id' => ['required', 'integer'],
            'listing_id' => ['required', 'integer'],
            'message' => ['required', 'max:1000', 'string']
        ]);

        $chat = new Chat();
        $chat->sender_id = auth()->user()->id;
        $chat->receiver_id = $request->receiver_id;
        $chat->message = $request->message;
        $chat->listing_id = $request->listing_id;
        $chat->save();

        broadcast(new Message($chat->message, $chat->listing_id, $chat->receiver_id));

        return response(['status' => 'success', 'message' => 'Message sent successfully']);
    }

    public function getMessages(Request $request)
    {
        $senderId = auth()->user()->id;
        $receiverId = $request->receiver_id;
        $listingId = $request->listing_id;
        $messages = Chat::with('senderProfile')
            ->whereIn('receiver_id', [$senderId, $receiverId])
            ->whereIn('sender_id', [$senderId, $receiverId])
            ->where('listing_id', $listingId)
            ->orderBy('created_at', 'asc')
            ->get();

        Chat::where([
            'sender_id' => $receiverId,
            'receiver_id' => $senderId,
            'listing_id' => $listingId,
            'seen' => 0])->update(['seen' => 1]);

        return $messages;
    }
}
