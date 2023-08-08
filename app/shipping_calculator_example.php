<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Services\Shipping\BillableWeightCalculatorService;
use App\Services\Shipping\DimDivisor;
use App\Services\Shipping\PackageDimension;
use App\Services\Shipping\Weight;

$package = [
    'weight' => 6,
    'dimension' => [
        'width' => 9,
        'length' => 15,
        'height' => 7,
    ],
];

$packageDimension = new PackageDimension(
    $package['dimension']['width'],
    $package['dimension']['height'],
    $package['dimension']['length'],
);

$weight = new Weight($package['weight']);
$billableWeightService = new BillableWeightCalculatorService();

$widerPackageDimension = $packageDimension->increaseWidth(10);

$billableWeight = $billableWeightService->calculate(
    $packageDimension,
    $weight,
    DimDivisor::FEDEX
);

$widerPackageBillableWeight = $billableWeightService->calculate(
    $widerPackageDimension,
    $weight,
    DimDivisor::FEDEX
);

echo $billableWeight . ' lb' . PHP_EOL;
echo $widerPackageBillableWeight . ' lb' . PHP_EOL;