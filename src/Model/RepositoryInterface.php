<?php

namespace Model;

interface RepositoryInterface
{
    public function fetchAll();

    public function findById($id);
}
