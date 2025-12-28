<h2>📊 Daily Sales Report</h2>

@if ($sales->isEmpty())
    <p>No sales today.</p>
@else
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity Sold</th>
                <th>Total Revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $item)
                <tr>
                    <td>{{ $item['product'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>RM {{ number_format($item['revenue'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
