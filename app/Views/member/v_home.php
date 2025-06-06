<?= $this->extend('../layouts/l_member') ?>
<?= $this->section('content') ?>

<div class="container">
  <h3 class="mb-4 text-white">List of Available Books</h3>
  <div class="row">
    <?php foreach ($data as $book) : ?>
      <div class="col-md-4 mb-4">
        <div class="card blur h-100">
          <div class="card-body d-flex flex-column">
            <h5><?= esc($book['title']) ?></h5>
            <span class="card-text"><strong>Penulis:</strong> <?= esc($book['author']) ?></span>
            <span class="card-text"><strong>Tahun:</strong> <?= esc($book['year_published']) ?></span>
            <p class="card-text"><strong>Tersedia:</strong> <?= esc($book['quantity_available']) ?> buah</p>
            <form method="post" action="<?= base_url('member/borrow/' . $book['book_id']) ?>">
              <?php if ($book['quantity_available'] > 0) : ?>
                <?php if ($book['borrowed']) : ?>
                  <span class="badge text-bg-success">Borrowed</span>
                <?php else : ?>
                  <button type="submit" name="action" value="borrow" class="btn btn-outline-primary w-100 mb-0">
                    Borrow Book
                  </button>
                <?php endif; ?>
              <?php else : ?>
                <span class="badge text-bg-secondary">Out of Stock</span>
              <?php endif; ?>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?= $this->endSection() ?>