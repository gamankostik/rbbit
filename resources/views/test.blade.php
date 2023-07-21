<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Test data</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Hash</th>
            <th>Amount</th>
            <th>Was generated</th>
            <th>Was sent</th>
            <th>Address to</th>
        </tr>
        </thead>
        <tbody>
        @foreach($coins as $coin)
        <tr>
            <td>{{$coin->number}}</td>
            <td>{{$coin->type}}</td>
            <td>{{$coin->hash}}</td>
            <td>{{$coin->amount}}</td>
            <td>{{!$coin->enabled}}</td>
            <td>{{!!$coin->used_at}}</td>
            <td>{{\App\Service\CoinService::transaction($coin->hash)->address_to ?? ''}}</td>
        </tr>
        @endforeach
        <!-- Add more rows as needed -->
        </tbody>
    </table>
    @if ($coins->links()->paginator->hasPages())
        <div class="mt-4 p-4 box has-text-centered">
            {{ $coins->links() }}
        </div>
    @endif
</div>

<!-- Link to Bootstrap JS and jQuery (for some components) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
