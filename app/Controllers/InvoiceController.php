<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Services\InvoiceService;
use App\View;

class InvoiceController
{
    public function __construct(private InvoiceService $invoiceService)
    {
    }

    #[Get('/invoices')]
    public function index(): View
    {
        return View::make(
            'invoices/index',
            ['invoices' => $this->invoiceService->getPaidInvoices()]
        );
    }
}