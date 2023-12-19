<h2><?= esc($title); ?></h2>
 
<?= \Config\Services::validation()->listErrors(); ?>
 
<form action="/news/edit/<?= esc($news['id']); ?>" method="post">
        <?= csrf_field() ?>
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" value="<?= esc($news['title']); ?>" />
    </div>    
    <div class="form-group">
        <label for="body">Text</label>
        <textarea class="form-control" name="body"><?= esc($news['body']); ?></textarea>
    </div>
    <a class="btn btn-sm btn-secondary mr-2" href="/news">Cancel</a>
    <button class="btn btn-sm btn-warning"  type="submit" name="submit">Edit news item</button>
</form>