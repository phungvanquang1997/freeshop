<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ChatRoom;
use App\Message;
use Input;
use App\UserMessage;
use Auth;
use Illuminate\Http\Request;

class MessageController extends BaseController {

    /**
     * @param Message $messages
     */
    public function __construct(Message $messages)
    {
        $this->messages = $messages;
    }

    /**
     * @param ChatRoom $chatRoom
     * @return mixed
     */
    public function getByChatRoom(ChatRoom $chatRoom)
    {
        return $chatRoom->messages;
    }

    /**
     * @param ChatRoom $chatRoom
     * @return static
     */
    public function createInChatRoom(ChatRoom $chatRoom, Request $request)
    {
        $message = $this->messages->newInstance(Input::all());

        $message->chatRoom()->associate($chatRoom);
        if (!Auth::guest()) {
            $message->user()->associate($this->me());
        } else {
            $message->user_id = $request->ip();
        }

        $message->save();

        $users = $chatRoom->userChatRoom()->where('user_id', '<>', $message->user_id)->get();
        if (!$users->isEmpty()) {
            foreach ($users as $key => $value) {
                $user_messages[] = new UserMessage([
                    'room_id' => $chatRoom->id,
                    'user_id' => $value->user_id,
                    'message_id' => $message->id,
                ]);
            }
            $message->userMessages()->saveMany($user_messages);
        }

        return $message;
    }


    /**
     * @param $lastMessageId
     * @param ChatRoom $chatRoom
     * @return mixed
     */
    public function getUpdates($lastMessageId, ChatRoom $chatRoom)
    {
        
        if (!Auth::guest()) {
            $user_mes = UserMessage::where('room_id', $chatRoom->id)->where('user_id', Auth::Id())->get();
            
            if ($user_mes) {
                foreach ($user_mes as $key => $value) {
                    $value->update(['read' => 1]);
                }
            }
        }
        return $this->messages->byChatRoom($chatRoom)->afterId($lastMessageId)->get();
    }
}