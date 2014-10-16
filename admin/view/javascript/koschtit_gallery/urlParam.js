function getParam(str,param){
       var vars = Array();
       var hashes = str.split('&');
                  for(var i = 0; i < hashes.length; i++){
                      var hash = hashes[i].split('=');
                      vars[hash[0]] = hash[1];
                    }
     return vars[param]
  }
