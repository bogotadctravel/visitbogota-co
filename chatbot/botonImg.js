function encender() {
    var botonRebeca = document.getElementById('btn-rebeca');
    
      if(botonRebeca.className == 'btn-chat'){
        botonRebeca.className = 'btn-equis';
      }
      else{
        botonRebeca.className = 'btn-chat';
      }
    } 