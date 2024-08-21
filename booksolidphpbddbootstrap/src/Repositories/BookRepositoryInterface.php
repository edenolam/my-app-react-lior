<?php

interface BookRepositoryInterface
{
    public function findAll();
    public function find($id);
    public function save(Book $book);
    public function delete($id);
}
