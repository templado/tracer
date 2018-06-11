<?php declare(strict_types = 1);
namespace Templado\Debug\Demo;

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


$tracer = new \Templado\Debug\Tracer();
$trm = $tracer->start($sample);

$x = $trm->getChild()->getData();
$y = $trm->getFoo();

$trace = $tracer->finish();

$printer = new \Templado\Debug\CoveragePrinter();
echo $printer->toText($trace);
