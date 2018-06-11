<?php declare(strict_types = 1);
namespace Templado\Debug;

use Traversable;

class TraceLog implements \IteratorAggregate, \Countable {

    /** @var Call[] */
    private $logData;

    /**
     * @param array $calls
     */
    public function __construct(array $calls) {
        $this->logData = $calls;
    }

    public function getIterator(): \Iterator {
        return new \ArrayIterator($this->logData);
    }

    public function count(): int {
        return count($this->logData);
    }

}
