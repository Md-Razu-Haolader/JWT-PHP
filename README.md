# JWT-PHP


> REST API example with JWT and Php

### Steps to call an API:

1. Call login api and get jwt token from response.

2. Call others api using that jwt token.

### Application structure:

1. Application root access file is index.php

2. Api examples are written in src\Services\Api.php file 

3. Application services location is src\Services

4. Application helper functions are written in src\Helper\Common.php file

5. Application common configuration are written in src\config\common.php

6. Application validation and request handler location is src\Request

### Postman request example:

![login-header](https://github.com/Md-Razu-Haolader/JWT-PHP/blob/master/examples/login-header.PNG 'login-header')

