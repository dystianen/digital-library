<?= $this->extend('../layouts/l_dashboard') ?>
<?= $this->section('content') ?>
<div class="card mb-4">
  <div class="card-header pb-0 d-flex justify-content-between">
    <h4>Book List</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah</button>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive px-4">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ISBN</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Author</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Year Published</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantity Available</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created at</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $startIndex = ($pager["currentPage"] - 1) * $pager["limit"] + 1; ?>
          <?php foreach ($data as $d) : ?>
            <tr>
              <td><?= $startIndex++ ?></td>
              <td><?= $d["isbn"] ?></td>
              <td><?= $d["title"] ?></td>
              <td><?= $d["author"] ?></td>
              <td><?= $d["year_published"] ?></td>
              <td><?= $d["quantity_available"] ?></td>
              <td><?= date_format(date_create($d['created_at']), 'd/m/Y') ?></td>
              <td>
                <div>
                  <i class="fas fa-edit" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $d['book_id'] ?>"></i>
                  <i class="fas fa-trash-alt" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $d['book_id'] ?>"></i>
                </div>
              </td>
            </tr>

            <!-- Modal: Edit Buku -->
            <div class="modal fade" id="editModal<?= $d['book_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $d['book_id'] ?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <form method="post" action="<?= base_url('admin/books/update/' . $d['book_id']) ?>">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel<?= $d['book_id'] ?>">Edit Buku</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <input type="text" name="isbn" class="form-control" value="<?= $d['isbn'] ?>" required>
                      </div>
                      <div class="mb-3">
                        <input type="text" name="title" class="form-control" value="<?= $d['title'] ?>" required>
                      </div>
                      <div class="mb-3">
                        <input type="text" name="author" class="form-control" value="<?= $d['author'] ?>" required>
                      </div>
                      <div class="mb-3">
                        <input type="number" name="year_published" class="form-control" value="<?= $d['year_published'] ?>" required>
                      </div>
                      <div class="mb-3">
                        <input type="number" name="quantity_available" class="form-control" value="<?= $d['quantity_available'] ?>" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- Modal: Hapus Buku -->
            <div class="modal fade" id="deleteModal<?= $d['book_id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $d['book_id'] ?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <form method="post" action="<?= base_url('admin/books/delete/' . $d['book_id']) ?>">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteModalLabel<?= $d['book_id'] ?>">Konfirmasi Hapus</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      Apakah Anda yakin ingin menghapus buku <strong><?= esc($d['title']) ?></strong>?
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <nav aria-label="Page navigation" class="mt-4 mx-4">
      <ul class="pagination d-flex gap-1" id="pagination">
        <!-- Dynamic pagination will be injected by JavaScript -->
      </ul>
    </nav>
  </div>
</div>

<!-- Add Book Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="<?php echo base_url(); ?>admin/books">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Buku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="isbn" class="form-control mb-2" placeholder="ISBN" required>
          <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
          <input type="text" name="author" class="form-control mb-2" placeholder="Author" required>
          <input type="number" name="year_published" class="form-control mb-2" placeholder="Year Published" required>
          <input type="number" name="quantity_available" class="form-control" placeholder="Quantity Available" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript">
  var currentURL = window.location.search;
  var urlParams = new URLSearchParams(currentURL);
  var pageParam = urlParams.get('page');

  function handlePagination(pageNumber) {
    window.location.href = `<?php echo base_url(); ?>admin/books?page=${pageNumber}`;
  }

  const paginationContainer = document.getElementById('pagination');
  const totalPages = <?= $pager["totalPages"] ?>;
  const currentPage = <?= $pager["currentPage"] ?>;

  if (totalPages >= 1) {
    // Previous button
    const prevItem = document.createElement('li');
    prevItem.classList.add('page-item');
    if (currentPage === 1) {
      prevItem.classList.add('disabled');
    }
    const prevLink = document.createElement('a');
    prevLink.classList.add('page-link');
    prevLink.href = 'javascript:void(0);';
    prevLink.setAttribute('aria-label', 'Previous');
    prevLink.innerHTML = '&laquo;';
    prevLink.addEventListener('click', function() {
      if (currentPage > 1) handlePagination(currentPage - 1);
    });
    prevItem.appendChild(prevLink);
    paginationContainer.appendChild(prevItem);

    // Numbered pages
    for (let i = 1; i <= totalPages; i++) {
      const pageItem = document.createElement('li');
      pageItem.classList.add('page-item');
      if (i === currentPage) pageItem.classList.add('active');

      const pageLink = document.createElement('a');
      pageLink.classList.add('page-link');
      pageLink.href = 'javascript:void(0);';
      pageLink.textContent = i;
      pageLink.addEventListener('click', function() {
        handlePagination(i);
      });

      pageItem.appendChild(pageLink);
      paginationContainer.appendChild(pageItem);
    }

    // Next button
    const nextItem = document.createElement('li');
    nextItem.classList.add('page-item');
    if (currentPage === totalPages) {
      nextItem.classList.add('disabled');
    }
    const nextLink = document.createElement('a');
    nextLink.classList.add('page-link');
    nextLink.href = 'javascript:void(0);';
    nextLink.setAttribute('aria-label', 'Next');
    nextLink.innerHTML = '&raquo;';
    nextLink.addEventListener('click', function() {
      if (currentPage < totalPages) handlePagination(currentPage + 1);
    });
    nextItem.appendChild(nextLink);
    paginationContainer.appendChild(nextItem);
  }
</script>
<?= $this->endSection() ?>