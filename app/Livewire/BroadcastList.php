<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\broadcastFormModel;
use Livewire\WithPagination;
use Livewire\Livewire;
use Illuminate\Support\Facades\Log;



class BroadcastList extends Component
{

    use WithPagination;
    protected $paginationTheme = 'simple-tailwind';

    public $broadcastToDelete;
    public $broadcastToEdit;
    public $isVisible;
    public function render()
    {
        return view('livewire.broadcast-list', [
            'dataBroadcast' => broadcastFormModel::paginate(5)
        ]);
    }

    public function deleteConfirm($id)
    {
        $this->isVisible = true;
        $this->broadcastToDelete = $id;
    }

    public function delete()
    {
        if ($this->broadcastToDelete) {
            $broadcast = broadcastFormModel::find($this->broadcastToDelete);
            if ($broadcast) {
                $broadcast->delete();
            } else {
                $this->addError('dataBroadcast', 'Broadcast Not Found');
            }
        }
    }

    public function editBroadcast($id)
    {
        return redirect()->route('broadcast-form', ['id' => $id]);
    }

    public function batal()
    {
        $this->isVisible = false;
    }
}
