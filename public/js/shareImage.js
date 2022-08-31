window.fbAsyncInit = function() {
    FB.init({appId: '576837394179343', status: true, xfbml: true});
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
         name: 'Ejemplo de publicación con dialogo ',
         link: 'https://www.codifica.me',
         caption: 'prueba caption',
         description: 'Descripción',
         message: 'El texto que quieres publicar'
       },
// Si quieres que salga una alerta
       function(response) {
         if (response.post_id) {
           alert('He publicado en el muro' );
         } else {
           alert('No he publicado');
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