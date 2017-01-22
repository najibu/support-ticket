<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Ticket;
use App\User;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CommentsController extends Controller
{
    public function postComment(Request $request, AppMailer $mailer)
    {
      $this->validate($request, [
        'comment' => 'required'
      ]);

      $comment = Comment::create([
        'ticket_id' => $request->input('ticket_id'),
        'user_id' => Auth::user()->id,
        'comment' => $request->input('comment'),
      ]);

      if ($comment->ticket->user->id !== Auth::user()->id) {
        $mailer->sendTicketComment($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }

        return redirect()->back()->with('status', 'Your comment has been submitted.');

    }
}