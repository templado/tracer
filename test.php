<?php declare(strict_types = 1);
namespace Templado\Tracer\Demo;

require __DIR__ . '/src/autoload.php';

class ChildModel {

    public function getData(): string {
        return 'Here is the child-data';
    }

    public function getSecond() {
        return 'second';
    }
}

class SampleModel {

    public function getFoo() {
        return 'bla';
    }

    public function getChild() {
        return new ChildModel();
    }

    public function getTest() {
        return 'test';
    }
}


$sample = new SampleModel();


$tracer = new \Templado\Tracer\Tracer();
$trm = $tracer->start($sample);

$x = $trm->getChild()->getData();
$y = $trm->getFoo();

$trace = $tracer->finish();

var_dump($trace);

$printer = new \Templado\Tracer\CoveragePrinter();
echo $printer->toText($trace);
