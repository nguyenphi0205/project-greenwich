Click on this link to change the new password<br>
<a href="{{ $link = url('password/reset' ,$token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">{{ $link }}</a>