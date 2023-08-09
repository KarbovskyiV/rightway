<table>
    <thead>
    <tr>
        <th>Invoice Number</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Due Date</th>
    </tr>
    </thead>
    <tbody>
    @forelse($invoices as $invoice)
        <tr>
            <td>{{ $invoice['invoiceNumber'] }}</td>
            <td>${{ number_format($invoice['amount'], 2) }}</td>
            <td>{{ $invoice['status'] }}</td>
            <td>
                @if ($invoice['dueDate'])
                    {{ date('m/d/Y', strtotime($invoice['dueDate'])) }}
                @else
                    N/A
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">No Invoices Found</td>
        </tr>
    @endforelse
    </tbody>
</table>