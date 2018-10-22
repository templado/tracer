<?php declare(strict_types = 1);
namespace Templado\Tracer;

class Call {

    /** @var object|null */
    private $parent;

    /** @var object */
    private $model;

    /** @var string */
    private $method;

    /** @var string|null */
    private $input;

    /** @var mixed */
    private $result;

    public function __construct(?object $parent, object $model, string $method, ?string $input, $result) {
        $this->parent = $parent;
        $this->model = $model;
        $this->method = $method;
        $this->input = $input;
        $this->result = $result;
    }

    public function getParent(): ?object {
        return $this->parent;
    }

    public function getModel(): object {
        return $this->model;
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function getInput(): ?string {
        return $this->input;
    }

    public function getResult() {
        return $this->result;
    }

}
