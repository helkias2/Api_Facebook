<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>
<script>

  function statusChangeCallback(response) {  
    console.log('statusChangeCallback');
                
    if (response.status === 'connected') {  
      testAPI();  
    } else {                            
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }


  function sair() {

    FB.logout(function(response) {  
      console.log(response);      
    });
  
  }

  function login() {
  

    FB.login(function(response) {  
      console.log(response);
      statusChangeCallback(response);  
    }, {scope: 'public_profile, email', auth_type: 'reauthorize'});
  
  }

  

  function checkLoginState() {   
    console.log('checando se a pessoa esta logada');         
    FB.getLoginStatus(function(response) {  
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '972830642916138',
      cookie     : true,                  
      xfbml      : true,                   
      version    : 'v6.0'       
    });

    FB.getLoginStatus(function(response) { 
      statusChangeCallback(response);      
    });
  };

  (function(d, s, id) {               
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/pt_BR/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

 
  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log(response);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }

</script>


<button onClick="login();">
  Entrar no Facebook
</button>

<button onClick="sair();">
  Sair do Facebook
</button>

<div id="status">
</div>

</body>
</html>