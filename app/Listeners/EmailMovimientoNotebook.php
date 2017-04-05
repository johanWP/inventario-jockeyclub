<?php

namespace App\Listeners;

use App\Events\MovimientoDeNotebook;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailMovimientoNotebook
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  MovimientoDeNotebook  $event
     * @return void
     */
    public function handle(MovimientoDeNotebook $event)
    {

        Mail::send('emails.movimientoNotebook', ['asset' => $event->asset, ''], function ($m)  {

            $m->from('sistemas@jockeyclub.com.ar', 'Sistema de Inventario Jockey club A.C.')->
            to('apiaggi@jockeyclub.com.ar', 'Alejandro Piaggi')->
            cc('mbeltramo@jockeyclub.com.ar', 'Martín Beltramo')->
            cc('hcenturion@jockeyclub.com.ar', 'Hector Centurión')->
            subject('Movimiento de Notebook');
        });
    }
}
