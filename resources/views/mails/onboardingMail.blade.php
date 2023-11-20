<p>Hello {{ $user['name'] }},</p>

<p>Welcome to our platform! Thank you for connecting we us. We have created an account for you. Your employee Id is {{ $user['employee_id'] }}.</p>

<p>Feel free to explore our platform and let us know if you have any questions or need assistance.</p>

<p> Your email is to login to our portal is - {{ $user['email']}} </p>

<p> Password is - {{ str_replace(" ", "",  strtolower($user['name']) . '@123')}}</p>

<p>Best regards,</p>
<p>RubIxx shails</p>
    


