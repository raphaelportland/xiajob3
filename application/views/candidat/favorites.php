<h2>Vos Books favoris</h2>

<?php foreach ($books as $key => $book) {
    $book->context = 'favorites';
	$this->load->view('books/templates/book_thumb',$book);

} ?>