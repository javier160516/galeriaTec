logInWithFacebook = function() {
  FB.login(function(response) {
    if (response.authResponse) {
      location = `/gallery/facebook.php`;
      // Now you can redirect the user or do an AJAX request to
      // a PHP script that grabs the signed request from the cookie.
    } else {
      alert('User cancelled login or did not fully authorize.');
    }
  });
  return false;
};
window.fbAsyncInit = function() {
  FB.init({
    appId: '767538411061963',
    cookie: true, // This is important, it's not enabled by default
    version: 'v14.0'
  });
};

(function(d, s, id){
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// window.fbAsyncInit = function() {
//     FB.init({appId: '767538411061963', status: true, xfbml: true});
//   };
//   (function() {
//     var e = document.createElement('script'); e.async = true;
//     e.src = document.location.protocol +
//       '//connect.facebook.net/es_ES/all.js';
//     document.getElementById('fb-root').appendChild(e);
//   }());
 
// function Publicar(){
//        FB.ui(
//        {
//             method: 'feed',
//             name: 'Ejemplo de publicación con dialogo',
//             link: 'https://www.codifica.me',
//             picture: 'https://static.remove.bg/remove-bg-web/3d75df900686714aa0c3f2ac38a019cdc089943e/assets/start_remove-c851bdf8d3127a24e2d137a55b1b427378cd17385b01aec6e59d5d4b5f39d2ec.png',
//             caption: 'prueba caption',
//             description: 'Descripción',
//             message: 'El texto que quieres publicar'
//        },
// // Si quieres que salga una alerta
//        function(response) {
//            if (response && !response.error_message) {
//                alert('Posting completed.');
//            } else {
//                alert('Error while posting.');
//            }
//        }
//      );
//  }