<?= $this->extend('../layouts/l_dashboard') ?>
<?= $this->section('content') ?>
<div class="card mb-4">
  <div class="card-header pb-0 d-flex justify-content-between">
    <h4>Borrowing</h4>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive px-4">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Member</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Borrow Date</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Return Date</th>
            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $startIndex = ($pager["currentPage"] - 1) * $pager["limit"] + 1; ?>
          <?php foreach ($data as $d) : ?>
            <tr>
              <td><?= $startIndex++ ?></td>
              <td><?= $d["full_name"] ?></td>
              <td><?= $d["title"] ?></td>
              <td><?= !empty($d["borrow_date"]) ? date_format(date_create($d['borrow_date']), 'd/m/Y') : '-' ?></td>
              <td><?= !empty($d["return_date"]) ? date_format(date_create($d['return_date']), 'd/m/Y') : '-' ?></td>
              <td><?= $d["borrow_status"] ?></td>
            </tr>
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
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript">
  var currentURL = window.location.search;
  var urlParams = new URLSearchParams(currentURL);
  var pageParam = urlParams.get('page');

  function handlePagination(pageNumber) {
    window.location.href = `<?php echo base_url(); ?>admin/borrowings?page=${pageNumber}`;
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