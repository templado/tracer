public function %method(string $originalValue = null)%type {
    $result = $this->model->%method($originalValue);

    $this->tracer->recordCall($this->model, '%method', $originalValue, $result);

    if (!is_object($result)) {
        return $result;
    }

    return $this->tracer->wrapModel($result);
}
