<?php

namespace App\Mail;

use App\Cliente;
use App\Habitacion;
use App\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class Email extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $cliente;
    public $habitacion;
   

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reserva, $cliente,$habitacion)
    {
        $this->reserva = $reserva;
        $this->cliente = $cliente;
        $this->habitacion = $habitacion;
        
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$reservacion = Reserva::where('folio','=',$this->id)->first();
        Log::debug(__METHOD__ . 'EMAIL ' . "INFO DE LA RESERVA " . $this->data);
        Log::debug(__METHOD__ . 'EMAIL ' . "INFO DEL CLIENTE " . $this->cliente);









        //Log::debug(__METHOD__ . 'EMAIL ' . "BUSCANDO ID CLIENTE EN RESERVACION " . var_dump($reservacion, true));

       /* $cliente = Cliente::findOrFail($reservacion->idCliente);
        $habitacion = Habitacion::findOrFail($reservacion->idHabitacion);
*/
        return $this->from('reservas@villadulcesuenos.com')
            ->subject("Nueva Reserva")
            ->view('utils/mail')->with(["datos"=>$this->reserva,'cliente'=>$this->cliente,'habitacion'=>$this->habitacion]);

        //return $this->view('utilsmail',["datos"=>$this->reserva,'cliente'=>$this->cliente,'habitacion'=>$this->habitacion]);
    }
}
