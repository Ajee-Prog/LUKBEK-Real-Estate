<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(20);

        return view(
            'admin.messages.index',
            compact('messages')
        );
    }

    public function show(Message $message)
    {
        if ($message->status === 'unread') {
            $message->update([
                'status' => 'read',
            ]);
        }

        return view(
            'admin.messages.show',
            compact('message')
        );
    }

    public function update(
        Request $request,
        Message $message
    ) {
        $validated = $request->validate([
            'status' => 'required|in:unread,read,replied,archived',
        ]);

        $message->update($validated);

        return back()->with(
            'success',
            'Message status updated.'
        );
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Message deleted.');
    }
}
