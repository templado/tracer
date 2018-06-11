<?php declare(strict_types = 1);
namespace Templado\Debug;

class Tracer {

    /** @var array */
    private $relations = [];

    /** @var array */
    private $models = [];

    /** @var array  */
    private $calls = [];

    public function start(object $model): object {
        $this->clear();
        return $this->wrapModel($model);
    }

    public function finish(): TraceLog {
        $log = new TraceLog($this->calls);
        $this->clear();
        return $log;
    }

    public function wrapModel(object $model): object {
        $this->models[spl_object_id($model)] = $model;

        $reflection = new \ReflectionObject($model);
        $className = $reflection->getName();

        $methodTpl      = file_get_contents(__DIR__ . '/templates/Method.tpl.php');
        $methodParamTpl = file_get_contents(__DIR__ . '/templates/MethodParam.tpl.php');

        $methods = [];
        foreach($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            $type = $reflectionMethod->hasReturnType() ? ': ' . $reflectionMethod->getReturnType() : '';

            $methods[] = str_replace(
                ['%method', '%type'],
                [$reflectionMethod->getShortName(), $type],
                $reflectionMethod->getNumberOfParameters() === 1 ? $methodParamTpl : $methodTpl
            );
        }

        $tracer = $this;
        $classTpl = file_get_contents(__DIR__ . '/templates/ProxyModel.tpl.php');
        $code = str_replace(
            ['%OrignalModel', '%methods'],
            [$className, implode("\n", $methods)],
            $classTpl
        );

        return eval($code);
    }

    public function recordCall(object $model, string $method, ?string $originalValue, $result): void {
        if (is_object($result)) {
            $this->registerRelation($model, $result);
        }
        $this->calls[] = new Call(
            $this->lookupRelation($model),
            $model,
            $method,
            $originalValue,
            $result
        );
    }

    private function registerRelation(object $model, object $result) {
        $this->relations[spl_object_id($result)] = spl_object_id($model);
    }

    private function lookupRelation(object $model): ?object {
        $id = spl_object_id($model);
        if (!isset($this->relations[$id])) {
            return null;
        }

        return $this->models[ $this->relations[$id] ];
    }

    private function clear(): void {
        $this->models = [];
        $this->calls = [];
        $this->relations = [];
    }

}
