public function %method()%type {
    $result = $this->model->%method();

    $this->tracer->recordCall($this->model, '%method', null, $result);

    if (!is_object($result)) {
        return $result;
    }

    return $this->tracer->wrapModel($result);
}
