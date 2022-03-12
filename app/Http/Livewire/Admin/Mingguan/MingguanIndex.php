<?php

namespace App\Http\Livewire\Admin\Mingguan;

use Livewire\Component;

class MingguanIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.mingguan.mingguan-index')
            ->extends('layouts.admin');
    }
}
