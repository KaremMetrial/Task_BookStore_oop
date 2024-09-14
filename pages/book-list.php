<?php
include "../includes/header.php";
include "../functions.php";
include '../classes/Book.php';
include '../classes/Cart.php';
include "../config/config.php";


$books = new Book($conn);
$books = $books->getBooks();

$carts = new Cart();
$getCart = $carts->getCart();

if (isset($_GET['title'], $_GET['author'], $_GET['price'])) {
    $title = htmlspecialchars($_GET['title']);
    $author = htmlspecialchars($_GET['author']);
    $price = floatval($_GET['price']);

    $book = ['title' => $title, 'author' => $author, 'price' => $price];

    if (in_array($book, $getCart)) {
        $mess = "<div class='alert alert-warning'>Book <strong>$title</strong> by $author is already in your cart!</div>";
    } else {
        $addCart = $carts->addBook($book);
        $mess = "<div class='alert alert-success'>Book <strong>$title</strong> by $author added to cart for $$price!</div>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'book-list.php';
                }, 1000);
              </script>";
    }
}

?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Book List</h2>

    <table class="table table-hover table-bordered table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $k => $book) : ?>
            <tr>
                <th scope="row"><?= $k + 1; ?></th>
                <td><?= htmlspecialchars($book['title']); ?></td>
                <td><?= htmlspecialchars($book['author']); ?></td>
                <td><?= formatPrice($book['price'], $currency, $transform); ?></td>
                <td>
                    <a href="?title=<?= $book['title']; ?>&author=<?= $book['author']; ?>&price=<?= $book['price']; ?>"
                       class="btn btn-sm btn-primary">Add to Cart</a>

                    <a href="book-details.php?id=<?= $book['id']; ?>"
                       class="btn btn-sm btn-info">Details</a>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php if (isset($mess)) {
        echo $mess;
    } ?>
</div>

<?php
include "../includes/footer.php";
?>
