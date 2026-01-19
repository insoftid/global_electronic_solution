<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display contact messages list.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::latest();

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $messages = $query->paginate(15);

        if ($request->ajax()) {
            return response()->json([
                'messages' => $messages->items(),
                'total' => $messages->total(),
            ]);
        }

        return view('Admin.Contacts', [
            'messages' => $messages,
        ]);
    }

    /**
     * Display the specified message.
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark as read if new
        if ($contactMessage->isUnread()) {
            $contactMessage->markAsRead();
        }

        return response()->json([
            'message' => $contactMessage,
        ]);
    }

    /**
     * Update message status.
     */
    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'status' => 'required|in:Baru,Dibaca,Dibalas',
        ]);

        $contactMessage->update(['status' => $validated['status']]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui',
                'contact' => $contactMessage,
            ]);
        }

        return back()->with('success', 'Status berhasil diperbarui');
    }

    /**
     * Add admin notes to message.
     */
    public function addNote(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'admin_notes' => 'required|string|max:2000',
        ]);

        $contactMessage->update(['admin_notes' => $validated['admin_notes']]);

        return response()->json([
            'success' => true,
            'message' => 'Catatan berhasil disimpan',
        ]);
    }

    /**
     * Remove the specified message.
     */
    public function destroy(Request $request, ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dihapus',
            ]);
        }

        return back()->with('success', 'Pesan berhasil dihapus');
    }
}
