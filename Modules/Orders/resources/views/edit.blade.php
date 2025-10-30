@extends('dashboard::layouts.app')

@section('title', 'Edit Order')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Order #{{ $order->id }}</h2>

    <form action="{{ route('orders.update', $order->id) }}" method="POST" id="orderForm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">Customer</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Order Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <h4 class="mt-4">Order Items</h4>

        <table class="table table-bordered mt-2" id="itemsTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th width="100">Quantity</th>
                    <th width="120">Price</th>
                    <th width="120">Total</th>
                    <th width="60">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>
                            <select name="items[{{ $loop->index }}][product_id]" class="form-control product-select">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                        {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="items[{{ $loop->index }}][quantity]" value="{{ $item->quantity }}" class="form-control quantity"></td>
                        <td><input type="number" name="items[{{ $loop->index }}][price]" value="{{ $item->price }}" class="form-control price" step="0.01"></td>
                        <td class="item-total">{{ number_format($item->price * $item->quantity, 2) }}</td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-item">X</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" class="btn btn-secondary" id="addItem">+ Add Product</button>

        <div class="mt-3 text-end">
            <h5>Total: $<span id="grandTotal">{{ number_format($order->total_price, 2) }}</span></h5>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const products = @json($products);
    const tableBody = document.querySelector('#itemsTable tbody');
    const addItemBtn = document.getElementById('addItem');
    const grandTotalEl = document.getElementById('grandTotal');

    function calculateTotal() {
        let total = 0;
        tableBody.querySelectorAll('tr').forEach(row => {
            const qty = parseFloat(row.querySelector('.quantity').value) || 0;
            const price = parseFloat(row.querySelector('.price').value) || 0;
            const rowTotal = qty * price;
            row.querySelector('.item-total').textContent = rowTotal.toFixed(2);
            total += rowTotal;
        });
        grandTotalEl.textContent = total.toFixed(2);
    }

    tableBody.addEventListener('input', calculateTotal);

    tableBody.addEventListener('change', function (e) {
        if (e.target.classList.contains('product-select')) {
            const selected = e.target.selectedOptions[0];
            const priceInput = e.target.closest('tr').querySelector('.price');
            priceInput.value = selected.dataset.price;
            calculateTotal();
        }
    });

    addItemBtn.addEventListener('click', function () {
        const index = tableBody.querySelectorAll('tr').length;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="items[${index}][product_id]" class="form-control product-select">
                    ${products.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name}</option>`).join('')}
                </select>
            </td>
            <td><input type="number" name="items[${index}][quantity]" value="1" class="form-control quantity"></td>
            <td><input type="number" name="items[${index}][price]" value="${products[0].price}" class="form-control price" step="0.01"></td>
            <td class="item-total">${products[0].price.toFixed(2)}</td>
            <td><button type="button" class="btn btn-danger btn-sm remove-item">X</button></td>
        `;
        tableBody.appendChild(row);
        calculateTotal();
    });

    tableBody.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('tr').remove();
            calculateTotal();
        }
    });

    calculateTotal();
});
</script>
@endsection

