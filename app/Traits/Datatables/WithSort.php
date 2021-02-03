<?php


namespace App\Traits\Datatables;


trait WithSort
{
    public $sortField = '';
    public $sortAsc = true;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
}
