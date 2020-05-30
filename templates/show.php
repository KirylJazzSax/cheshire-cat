<?php $extends = 'app/layout' ?>

<div class="d-grid" id="app">
    <div class="d-grid">
        <div class="card m-auto" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?= $announcement['title'] ?></h5>
                <div class="card-subtitle mb-2 text-muted">ID <?= $announcement['id'] ?></div>
                <p class="card-text">Цена: <?= $announcement['price'] ?></p>
                <p class="card-text">Описание: <?= $announcement['description'] ?></p>
                <a href="/" class="card-link">На главную</a>
                <a href="/announcement/create" class="card-link">Создать?</a>
            </div>
        </div>
    </div>
</div>
