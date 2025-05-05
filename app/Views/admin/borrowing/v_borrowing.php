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
    <nav aria-label="Page navigation example" class="custom-navigation">
      <ul class="pagination" id="pagination">
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

  // PAGINATION
  function handlePagination(pageNumber) {
    window.location.replace(`<?php echo base_url(); ?>admin/books?page=${pageNumber}`);
  }

  var paginationContainer = document.getElementById('pagination');
  var totalPages = <?= $pager["totalPages"] ?>;
  if (totalPages >= 1) {
    for (var i = 1; i <= totalPages; i++) {
      var pageItem = document.createElement('li');
      pageItem.classList.add('page-item');
      pageItem.classList.add('primary');
      if (i === <?= $pager["currentPage"] ?>) {
        pageItem.classList.add('active');
      }

      var pageLink = document.createElement('a');
      pageLink.classList.add('page-link');
      pageLink.href = 'javascript:void(0);'
      pageLink.textContent = i;

      pageLink.addEventListener('click', function() {
        var pageNumber = parseInt(this.textContent);
        handlePagination(pageNumber);
      });

      pageItem.appendChild(pageLink);
      paginationContainer.appendChild(pageItem);
    }
  }
</script>
<?= $this->endSection() ?>