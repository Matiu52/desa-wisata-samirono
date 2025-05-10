<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->paginate(10);
        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(Contact $message)
    {
        return view('admin.contact-messages.show', compact('message'));
    }

    public function destroy(Contact $message)
    {
        $message->delete();
        return redirect()->route('contact-messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
