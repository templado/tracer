<?php declare(strict_types = 1);
namespace Templado\Debug;

class TextPrinter {

    public function toText(TraceLog $log): string {
        $buffer = count($log) . " calls recorded: \n";

        foreach($log as $call) {
            /** @var Call $call */
            $buffer .= sprintf("- %s->%s(%s) => %s\n",
                \get_class($call->getModel()),
                $call->getMethod(),
                $call->getInput(),
                \is_scalar($call->getResult()) ? $call->getResult() : \get_class($call->getResult())
            );
        }

        return $buffer;
    }
}
