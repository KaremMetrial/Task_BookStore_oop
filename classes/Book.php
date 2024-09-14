<?php

class Book
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getBooks()
    {
        $stmt = $this->db->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBook($id)
    {
        $stmt = $this->db->query("SELECT * FROM books WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
