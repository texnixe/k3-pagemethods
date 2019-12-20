# k3-pagemethods

A collection of page methods for Kirby 3.


## Usage example for `getPrev()`/`getNext()`


```
<?php $collection = $page->siblings()->filterBy('template', 'article') ?>

<?php if ($collection->isNotEmpty()) : ?>
  <?php if ($prevPage = $page->getPrev($collection)) : ?>
      <a href="<?= $prevPage->url() ?>"><?= $prevPage->title()->html() ?></a>
  <?php endif ?>

  <?php if ($nextPage = $page->getNext($collection)) : ?>
      <a href="<?= $nextPage->url() ?>"><?= $nextPage->title()->html() ?></a>
  <?php endif ?>
<?php endif ?>
```
