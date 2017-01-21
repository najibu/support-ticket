<?php 

namespace App\Mailers;

use App\User;
use App\Ticket;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer {
  protected $mailer; 
  protected $fromAddress = 'ns.najibu@gmail.com'
  protected $fromName = 'Support Ticket';
  protected $to; 
  protected $subject;
  protected $view; 
  protected $data = [];

  public function __construct(Mailer $mailer)
  {
    $this->mailer = $mailer;
  }

  public function sendTicketInformation(User $user, Ticket $ticket)
  {
    $this->to = $user->emaill
    $this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->title";
    $this->view = 'emails.ticket_info';
    $this->data = compact('user', 'ticket');

    return $this->deliver();
  }

  public function deliver()
  {
    $this->mailer->send($this->view, $this->data, function($message){
        $message->from($this->fromAddress, $this->fromName)
        ->to($this->to)->subject($this->subject);
    });
  }
}