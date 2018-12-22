<?php 
Kirby::plugin('texnixe/pagemethods', [
    'pageMethods' => [
        'getIndex' => function($collection) {
            if($collection->has($this)) {
                $index = $collection->indexOf($this);
                return $index;
            }
        },
        'getRootParent' => function() {
            if($this->depth() == 1 && !$this->isHomePage()) {
                return $this;
            }
            return $this->parents()->last();
        },
        'hasParents' => function(): bool {
            return $this->parents()->count();
        },
        'maxDepth' => function() {
            $depth = [];
            if($this->index()->count() > 1) {
                foreach($this->index() as $p) {
                    $depth[] = $p->depth();
                }
                return max($depth);
            }
            return null;       
        },
        'canonicalUrl' => function() {
            return $this->url() . r(params() || $this->isHomePage(), '/') . kirby()->request()->params();
        },
        'getPrev' => function($siblings, $sort = [], $status = false) {
            if($sort) $siblings = call(array($siblings, 'sortBy'), $sort);
            $index = $siblings->indexOf($this);
            if($index === false or $index === 0) return null;
            if($status) {
              $siblings = $siblings->limit($index);
              $siblings = $siblings->{$status}();
              return $siblings->last();
            } else {
              return $siblings->nth($index - 1);
            }
        },
        'getNext' => function($siblings, $sort = [], $status = false) {
            if($sort) $siblings = call([$siblings, 'sortBy'], $sort);
            $index = $siblings->indexOf($this);
            if($index === false) return null;
            if($status) {
              $siblings = $siblings->offset($index+1);
              $siblings = $siblings->{$status}();
              return $siblings->first();
            } else {
              return $siblings->nth($index + 1);
            }
        },
        
    ]
]);