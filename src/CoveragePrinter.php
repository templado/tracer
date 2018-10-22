<?php declare(strict_types = 1);
namespace Templado\Tracer;

class CoveragePrinter {

    public function toText(TraceLog $log): string {
        $models = [];
        $calls = [];

        foreach($log as $call) {
            /** @var Call $call */
            $id = spl_object_id($call->getModel());
            if (!isset($this->models[$id])) {
                $models[$id] = $call->getModel();
            }

            if (!isset($calls[$id])) {
                $calls[$id] = [];
            }
            $calls[$id][] = $call->getMethod();
        }


        $buffer = '';
        foreach($models as $model) {
            $id = spl_object_id($model);
            $ro = new \ReflectionObject($model);
            $called = $calls[$id];

            $cols=[[],[]];
            $len=10;

            foreach($ro->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                $name = $method->getShortName();
                $pos = \in_array($name, $called, true) ? 0 : 1;
                $cols[$pos][] = $name;
                $len = max($len, \strlen($name));
            }

            $title = \get_class($model);
            $len = max($len, (int)ceil( \strlen($title) / 2));

            $buffer .= str_pad($title,  $len * 2 + 7, ' ', STR_PAD_BOTH). "\n";

            $buffer .= '+' . str_pad('',$len + 2, '-') . '+';
            $buffer .= str_pad('',$len + 2, '-') . "+\n";
            $buffer .= '| ' . str_pad('Called', $len, ' ', STR_PAD_RIGHT);
            $buffer .= ' | ';
            $buffer .= str_pad('Not Called', $len, ' ', STR_PAD_RIGHT) . " |\n";
            $buffer .= '+' . str_pad('',$len + 2, '-') . '+';
            $buffer .= str_pad('',$len + 2, '-') . "+\n";

            $max = max(\count($cols[0]), \count($cols[1]));
            for($t=0; $t<$max; $t++) {
                $left = $cols[0][$t] ?? '';
                $right = $cols[1][$t] ?? '';

                $buffer .= '| ' . \str_pad($left, $len, ' ', STR_PAD_RIGHT);
                $buffer .= ' | ';
                $buffer .= \str_pad($right, $len, ' ', STR_PAD_RIGHT) . " |\n";

            }
            $buffer .= '+' . \str_pad('',$len + 2, '-') . '+';
            $buffer .= \str_pad('',$len + 2, '-') . "+\n\n";
        }

        return $buffer;
    }
}
