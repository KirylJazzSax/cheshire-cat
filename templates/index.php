<?php $extends = 'app/layout' ?>

<div class="d-grid" id="app">
    <div class="d-flex justify-content-center mb-4">
        <a href="/announcement/create" class="btn btn-success">Создать объявление</a>
    </div>
    <div class="d-grid m-auto">
        <?php if ($pages > 1): ?>
            <nav aria-label="Странички" class="d-flex justify-content-center">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $pages; $i++): ?>
                        <li class="page-item <?= (!isset($_GET['page']) && $i === 1) || $_GET['page'] == $i ? 'active' : '' ?>">
                            <a class="page-link" href="<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
        <div class="sorting d-flex justify-content-center">
            <a href="#" data-sort="created_at" data-order="asc" class="sort mr-3">По дате</a>
            <a href="#" data-sort="price" data-order="asc" class="sort">По цене</a>
        </div>
    </div>
    <div id="announcements"></div>
</div>
