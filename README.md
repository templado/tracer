# Templado Tracer
Helper for tracing View Model calls within the Templado Engine

> __Warning__
>
> The Code within this repository was designed to work with Templado 4.x or earlier.
> It will _not_ (yet) work Templado 5.x or later.
>
> 

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
