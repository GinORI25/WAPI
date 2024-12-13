<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Custompayment;

class Buy extends Component
{
    public $payment;

    public function mount($id)
    {
        $this->payment = Custompayment::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.buy', [
            'payment' => $this->payment,
        ]);
    }
}
