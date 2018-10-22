return new class($tracer, $model) extends %OrignalModel {

    private $model;
    private $tracer;

    public function __construct(Templado\Tracer\Tracer $tracer, object $model) {
        $this->tracer = $tracer;
        $this->model = $model;
    }

    %methods

};
