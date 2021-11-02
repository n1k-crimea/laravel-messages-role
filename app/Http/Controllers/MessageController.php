<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Illuminate\Support\Facades\Date;

class MessageController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $messages = Message::with('user')->get();
        return view('message.list', compact('messages'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if(is_null(Auth::user()->messages()->first())) {
            return view('message.create');
        }
        $timeLastMessage = Auth::user()->messages()->latest()->first()->created_at;
        if (date_diff($timeLastMessage, Date::now())->h >= 24) {
            return view('message.create');
        } else {
            return view('message.create', [
                'timeLastMsg' => $timeLastMessage->format('H:i:s d-m-Y'),
                'timeNextMsg' => date('H:i:s d-m-Y', strtotime($timeLastMessage. ' + 1 days'))
            ]);
        }
//        return view('message.create');
    }


    /**
     * @param StoreMessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMessageRequest $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->file('input_file')) {
            $path_file = $this->getPathImage($request);
        }
        $message = new Message(array_merge($request->only('subject', 'body'), ['path_file'=>$path_file ?? null]));
        Auth::user()->messages()->save($message);

        return redirect()->route('client_message_create')->with('success','Сообщение было отправлено');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id): \Illuminate\Http\RedirectResponse
    {
        $message = Message::find($id);
        $message->viewed = !$message->viewed;
        $message->save();
        return redirect()->back();
    }

    /**
     * @param $request
     * @return string
     */
    public function getPathImage($request): string
    {
        $file = $request->file('input_file');
        $filenameWithExt = $file->getClientOriginalName();
        $upload_folder = 'public/folder';
        $request->file('input_file')->storeAs($upload_folder, $filenameWithExt);
        $path_file = '/storage/folder/' .$filenameWithExt;
        return $path_file;
    }
}
