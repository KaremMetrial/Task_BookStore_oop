<?php

class Cart
{
    public function addBook($book)
    {
        $_SESSION["cart"][] = $book;
    }
    public function getCart()
    {
        return isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
    }
    public function removeBook($id){
        foreach ($_SESSION["cart"] as $key => $book){
            if ($book['id'] == $id){
                unset($_SESSION["cart"][$key]);
            }
        }
    }

    public function getTotalPrice()
    {
        $total = 0;
        foreach ($_SESSION["cart"] as $book){
            $total += $book['price'];
        }
        return $total;
    }
}
