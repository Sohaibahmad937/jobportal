<table cellspacing="0" style="font:12px/16px Arial,sans-serif;color:#333;background-color:#fff;margin:0 auto" cellpadding="0">
    <tr>
        <td>
            <img src="{{ asset('front_assets/img/mail_tem.png') }}" style="width:100%">
        </td>
    </tr>
    @php
        $firstName = explode(' ', $name);
    @endphp
    <tr>
        <td>
            <b>Dear {{ $firstName[0] }} , </b><br><br><br>
            Greetings from Purefresh<br><br>
            <ul>
                <li>Agarbatti running out of stock?</li>
                <li>Fret not, visit us at www.mjdmart.com and get registered.Our automated reminder will notify you every 15 days to refill your Agarbatti stock.While you are at it, how about checking out our Festive Collection?We’ve got some really irresistible offers that would add fragrance to your celebrations.Let the festivities begin!</li>
            </ul>
        </td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td>Thank you for shopping with us!</td>
    </tr>
    <tr>
        <td><b>Regards,<br>
            Team Mjdmart.com</b></td>
    </tr>

</table>