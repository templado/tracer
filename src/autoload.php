<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'templado\\tracer\\call' => '/Call.php',
                'templado\\tracer\\coverageprinter' => '/CoveragePrinter.php',
                'templado\\tracer\\textprinter' => '/TextPrinter.php',
                'templado\\tracer\\tracelog' => '/TraceLog.php',
                'templado\\tracer\\tracer' => '/Tracer.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    },
    true,
    false
);
// @codeCoverageIgnoreEnd
