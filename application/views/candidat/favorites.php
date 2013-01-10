<h1>Vos Books favoris</h1>

<?php foreach ($books as $key => $book) {
    $book->context = 'favorites';
	$this->load->view('books/templates/book_thumb',$book);

} ?>