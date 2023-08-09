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
    <?php if (empty($invoices)): ?>
        <tr>
            <td colspan="4">No Invoices Found</td>
        </tr>
    <?php else: ?>
        <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= $invoice['invoiceNumber'] ?></td>
                <td>$<?= number_format($invoice['amount'], 2) ?></td>
                <td><?= $invoice['status'] ?></td>
                <td>
                    <?php if ($invoice['dueDate']): ?>
                        <?= date('m/d/Y', strtotime($invoice['dueDate'])) ?>
                    <?php else: ?>
                        N/A
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif ?>
    </tbody>
</table>