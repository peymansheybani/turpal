<?php

namespace App\Suppliers\Contracts;

interface ISupplier
{
    public function list(int $page = 1, int $limit = 10) : array;

    public function detail(string|int $id) : array;

    public function getPrice(string|int $id, int $page = 1, int $limit = 10) : array;
    public function availability(string|int $id) : bool;
}
