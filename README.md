# JWT-PHP


> REST API example with JWT and Php

### Steps to call an API:

1. Call login api and get jwt token from response.

![login-header](https://github.com/Md-Razu-Haolader/JWT-PHP/blob/main/examples/login-header.PNG 'login-header')
![login-response](https://github.com/Md-Razu-Haolader/JWT-PHP/blob/main/examples/login-response.PNG 'login-response')

2. Call others api using that jwt token.

![getpost](https://github.com/Md-Razu-Haolader/JWT-PHP/blob/main/examples/getpost.PNG 'getpost')

### Application structure:

1. Application root access file is index.php

2. Sample api request file is sample_request.php

3. Api examples are written in src\Services\Api.php file 

4. Application services location is src\Services

5. Application helper functions are written in src\Helper\Common.php file

6. Application common configuration are written in src\config\common.php

7. Application validation and request handler location is src\Request



