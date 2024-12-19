<?php

namespace App\Livewire;

use App\Models\Ticket;
use App\Services\GiphyService;
use Livewire\Component;

class Tickets extends Component
{
    public $tickets, $description, $name, $difficulty, $id_ticket,$status;
    public $modal = false;

    public function render()
    {
        $this->tickets = Ticket::all();
        return view('livewire.tickets');
    }

    public function crear()
    {
        $this->limpiarCampos();
        $this->abrirModal();
    }

    public function abrirModal()
    {
        $this->modal = true;
    }
    public function cerrarModal()
    {
        $this->modal = false;
    }

    public function limpiarCampos()
    {
        $this->name = '';
        $this->description = '';
        $this->difficulty = '';
    }

    public function editar($id)
    {
        // Buscar el ticket por ID
        $ticket = Ticket::findOrFail($id);

        // Asignar los valores del ticket a las propiedades del componente Livewire
        $this->id_ticket = $ticket->id;
        $this->name = $ticket->name;
        $this->description = $ticket->description;
        $this->difficulty = $ticket->difficulty;

        // Abrir el modal
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Ticket::find($id)->delete();
        session()->flash('message', 'Registro eliminado correctamente');
    }

    public function guardar()
    {
        $gifUrl = GiphyService::generarGifUrl($this->difficulty);

        Ticket::updateOrCreate(
            ['id' => $this->id_ticket],
            [
                'name' => $this->name,
                'description' => $this->description,
                'difficulty' => $this->difficulty,
                'gif_url' => $gifUrl,
                'completed' => $this->status,
            ]
        );

        session()->flash(
            'message',
            $this->id_ticket ? '¡Actualización exitosa!' : '¡Alta exitosa!'
        );

        $this->cerrarModal();
        $this->limpiarCampos();
    }
}
