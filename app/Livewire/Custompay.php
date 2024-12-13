<?php

namespace App\Livewire;

use App\Models\Custompayment;
use Livewire\Component;

class Custompay extends Component
{
    public $paymentId;
    public $iduser;
    public $nama;
    public $username;
    public $harga_bayar;
    public $metode_bayar;
    public $catatan;
    public $inputValue = '';

    protected $rules = [
        'iduser' => 'required|string',
        'nama' => 'required|string',
        'username' => 'required|string',
        'harga_bayar' => 'required|string',
        'metode_bayar' => 'required|string',
        'catatan' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        // Simpan atau update data ke database
        if ($this->paymentId) {
            $payment = Custompayment::find($this->paymentId);
            $payment->update([
                'iduser' => $this->iduser,
                'nama' => $this->nama,
                'username' => $this->username,
                'harga_bayar' => $this->harga_bayar,
                'metode_bayar' => $this->metode_bayar,
                'catatan' => $this->catatan,
            ]);
        } else {
            $payment = Custompayment::create([
                'iduser' => $this->iduser,
                'nama' => $this->nama,
                'username' => $this->username,
                'harga_bayar' => $this->harga_bayar,
                'metode_bayar' => $this->metode_bayar,
                'catatan' => $this->catatan,
            ]);
        }

        $this->resetForm();

        return redirect()->route('buy', ['id' => $payment->id]);
    }

    private function resetForm()
    {

        $this->reset(['iduser', 'nama', 'username', 'harga_bayar', 'metode_bayar', 'catatan']);

        $this->inputValue = '';
    }

    public function render()
    {
        $dataPayment = Custompayment::orderBy('created_at', 'desc')->paginate(8);
        return view('livewire.custompay', compact('dataPayment'));
    }
}
