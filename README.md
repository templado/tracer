# Templado Tracer
Helper for tracing View Model calls within the Templado Engine

## Sample Usage

```php
$html = \Templado\Engine\Templado::loadHtmlFile('...');
$tracer = new \Templado\Tracer\Tracer();

$traceModel = $tracer->start(new SampleModel());

$html->applyViewModel($traceModel);

$trace = $tracer->finish();

$printer = new \Templado\Tracer\CoveragePrinter();
echo $printer->toText($trace);
```
