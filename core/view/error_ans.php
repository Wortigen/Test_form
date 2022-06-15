<div class="row">
    <ul>
        <? foreach ($errors as $error): ?>
            <li class="text-danger"><?= $error; ?></li>
        <? endforeach; ?>
    </ul>
</div>