<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Existing methods...

    public $messageText;

    public function getUserMessages()
    {
        // Fetch user messages
        $userMessages = Chat::latest()->get();

        // Return the view with user messages
        return view('admin.messages', ['userMessages' => $userMessages]);
    }

    public function submitContactForm(Request $request)
    {
        $request->validate([
            'sender_name' => 'required',
            'message' => 'required',
        ]);

        // Save the message to the database
        Chat::create([
            'sender_name' => $request->input('sender_name'),
            'message' => $request->input('message'),
        ]);

        // Redirect back with a success message
        return back()->with('success', 'Message sent successfully!');
    }

    public function showContactForm()
    {
        return view('admin.messages'); // Replace 'admin.contact_form' with the actual view name
    }

    public function submitAdminReply(Request $request, $messageId)
    {
        $request->validate([
            'admin_reply' => 'required',
        ]);

        // Find the message by ID
        $message = Chat::findOrFail($messageId);

        // Save the admin reply to the message
        $message->admin_reply = $request->input('admin_reply');
        $message->save();

        // Redirect back with a success message
        return redirect()->route('admin.getUserMessages')->with('success', 'Reply sent successfully!');
    }
    public function render()
    {
//        dd("ok");
        $messages = Message::with('customer')->latest()->take(10)->get()->sortBy('id');
        return view('livewire.chat', compact('messages'));
    }


}
