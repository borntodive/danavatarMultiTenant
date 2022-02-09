<?php

namespace App\Traits\Datatables;

trait WithSearch
{
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
