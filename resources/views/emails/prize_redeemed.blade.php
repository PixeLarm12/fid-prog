<div>
    <h1>Thank you for redeemed {{ $mailData['prize'] }}</h1>

    <p>
        <ul>
            <li>Points spent: {{ $mailData['cost'] }}</li>
            <li>Balance: {{ $mailData['balance'] }}</li>
            <li>Redeem date: {{ $mailData['date'] }}</li>
        </ul>
    </p>
</div>