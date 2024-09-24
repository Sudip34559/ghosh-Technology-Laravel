<!DOCTYPE html>
<html>
<head>
    <title>Products List</title>
    <style>
        @import url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

        /* Additional custom styles to ensure Bootstrap works well in PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Products List</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($products as $product)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $product->prod_list }}</td>
                        <td>{{ $product->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
