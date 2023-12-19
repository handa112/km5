<h2><?= esc($title); ?></h2>
 
<?= \Config\Services::validation()->listErrors(); ?>
 
<form action="/news/create" method="post">
        <?= csrf_field() ?>
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" value="" />
    </div>    
    <div class="form-group">
        <label for="body">Text</label>
        <textarea class="form-control" name="body"></textarea>
    </div>
    <a class="btn btn-sm btn-secondary mr-2" href="/news">Cancel</a>
    <button class="btn btn-sm btn-success"  type="submit" name="submit">Create news item</button>
</form>