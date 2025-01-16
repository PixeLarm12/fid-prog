<div>
    <h1>Thank you for recent purchase!</h1>
    
    <p>
        <ul>
            <li>Total price: {{ $mailData['total_price'] }}</li>
            <li>Date: {{ $mailData['date'] }}</li>
        </ul>
    </p>


    <h3>With this purchase you've earned: {{ $mailData['points'] }} points! Don't forget to redeemed your prizes!</h3>
    
</div>