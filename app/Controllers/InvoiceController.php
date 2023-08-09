<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\View;

class InvoiceController
{
    #[Get('/invoices')]
    public function index(): View
    {
        $invoices = Invoice::query()
            ->where('status', InvoiceStatus::Paid)
            ->get()
            ->map(
                fn(Invoice $invoice) => [
                    'invoiceNumber' => $invoice->invoice_number,
                    'amount' => $invoice->amount,
                    'status' => $invoice->status->toString(),
                    'dueDate' => $invoice->due_date->toDateTimeString(),
                ]
            )
            ->toArray();

        return View::make('invoices/index', ['invoices' => $invoices]);
    }
}