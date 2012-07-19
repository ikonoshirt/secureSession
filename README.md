#SecureSession

## The Problems and Solutions

https://www.owasp.org/index.php/Category:OWASP_Top_Ten_Project

One picked: Top 10 2010-A3-Broken Authentication and Session Management

https://www.owasp.org/index.php/Top_10_2010-A3

### sessions in the URL & session hijacing
If you have a session in the url it is a sign for a low level attempt to hijack a session.
So, if we find a session in the url, we destroy the session.

If the hacker is better, he uses cookies - as the user does, so we change the session id for every request, what means,
the time frame for hijacking the session is very much shorter.

### session fixation attacks & session id change after login
One way is to steal the sessionid for a authenticated user, the other way is to generate a session and then let the user
use this generated session id to authenticate.

If we set a new cookie and generate a new session id after login, this can no longer happen



### session id only transported over https (TODO)
We check in the backend wether the secure and unsecure URL are https urls, if not we show a warning dialog.