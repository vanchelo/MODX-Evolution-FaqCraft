<section class="cd-faq">
<ul class="cd-faq-categories">
<?php foreach ($categories as $c): ?>
    <?php if (!$c->faqs) continue; ?>
    <li><a href="#category_<?= $c->id ?>"><?= $c->title ?></a></li>
<?php endforeach ?>
</ul> <!-- cd-faq-categories -->

<div class="cd-faq-items">
<?php foreach ($categories as $c): ?>
<?php if (!$c->faqs) continue; ?>
<ul id="category_<?= $c->id ?>" class="cd-faq-group">
    <li class="cd-faq-title"><h2><?= $c->title ?></h2></li>
    <?php foreach ($c->faqs as $f): ?>
    <li>
        <a class="cd-faq-trigger" href="#0"><?= $f->question ?></a>
        <div class="cd-faq-content"><?= $f->answer ?></div> <!-- cd-faq-content -->
    </li>
    <?php endforeach ?>
</ul>
<?php endforeach ?>
</div> <!-- cd-faq-items -->
<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
