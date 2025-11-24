<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Transaction;
use App\Models\TransactionMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionMessageController extends Controller
{
    public function store(MessageRequest $request)
    {
        $userId = Auth::id();
        $transaction = Transaction::findOrFail($request->transaction_id);
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('transaction_images', 'public');
        }
        DB::transaction(function() use ($request, $userId, $transaction, $path) {
            TransactionMessage::create([
                'transaction_id' => $transaction->id,
                'sender_id' => $userId,
                'message' => $request->message,
                'image_path' => $path
            ]);

            $transaction->update(['last_message_at' => now()]);
        });

        return redirect()->back();
    }

    public function update(MessageRequest $request, $id)
    {
        $msg = TransactionMessage::where('id', $id)
                ->where('sender_id', Auth::id())
                ->firstOrFail();
        $msg->message = $request->message;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('transaction_images', 'public');
            $msg->image_path = $path;
        }
        $msg->save();

        return back();
    }

    public function delete($id)
    {
        $msg = TransactionMessage::findOrFail($id);
        if ($msg->sender_id !== Auth::id()) {
            abort(403);
        }
        if ($msg->image_path && \Storage::disk('public')->exists($msg->image_path)) {
            \Storage::disk('public')->delete($msg->image_path);
        }
        $msg->delete();

        return redirect()->back();
    }
}
