<?php $extends = 'app/layout' ?>

<div class="w-50 m-auto create-announcement" novalidate>
    <div class="alert alert-success d-none" role="alert"></div>
    <div class="alert alert-danger d-none" role="alert"></div>
    <form action="/announcement/create">
        <input type="hidden" name="csrf" value="<?= $token ?>">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="text" class="form-control" name="price">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
            <div class="invalid-feedback"></div>
        </div>
    </form>
    <button class="btn btn-primary">Создать</button>
</div>

