<div class="pagination">
        <?php for ($i = 1; $i <= $model['pages']; $i++): ?>
            <a href="?page=<?= $i ?>" <?= $i == $model['currentPage'] ? 'class="active"' : '' ?>><?= $i ?></a>
        <?php endfor; ?>
</div>