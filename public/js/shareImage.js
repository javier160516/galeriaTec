window.fbAsyncInit = function() {
    FB.init({appId: '767538411061963', status: true, xfbml: true});
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      '//connect.facebook.net/es_ES/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
 
function Publicar(){
       FB.ui(
       {
            method: 'feed',
            name: 'Ejemplo de publicación con dialogo',
            link: 'https://www.codifica.me',
            picture: 'https://static.remove.bg/remove-bg-web/3d75df900686714aa0c3f2ac38a019cdc089943e/assets/start_remove-c851bdf8d3127a24e2d137a55b1b427378cd17385b01aec6e59d5d4b5f39d2ec.png',
            caption: 'prueba caption',
            description: 'Descripción',
            message: 'El texto que quieres publicar'
       },
// Si quieres que salga una alerta
       function(response) {
           if (response && !response.error_message) {
               alert('Posting completed.');
           } else {
               alert('Error while posting.');
           }
       }
     );
 }
// function postStory() {
//     FB.init({appId: "2976936949265574", status: true, cookie: true});
//     var publish = {
//         method: 'stream.publish',
//         message: 'publicar en el muro del usuario',
//         picture : 'http://ruta/logo.gif',
//         link : 'http://ruta/facebook/',
//         name: 'Publicar utilizando javascript',
//         caption: 'El caption del post',
//         description: 'descripción de la aplicación',
//         actions : { name : 'prueba',
//         link : 'http://www.codigojavaoracle/fb_dev/index.php'}
//       };
    
//       FB.api('/me/feed', 'POST', publish, function(response) {
//           document.getElementById('confirmMsg').innerHTML =
//                  'Alerta de confirmación.';
//       });
// }