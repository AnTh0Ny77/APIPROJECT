<?php

namespace Src\Controllers;
require_once  'vendor/autoload.php';


class DocController  {
  
    public function index() {
        header("Content-type: application/json");
        echo '{
            "API": {


                "Utilisateurs": { 
                    "Authentification": {
                        "path": "/auth",
                        "method" : "POST",
                        "forms": {
                            "email" : "exempale@cretin.com", 
                            "password" : "resr1243456!"
                        },
                        "responses": {
                            "success": {

                            }, "errors": {

                            }
                        }
                    }
                } 



            }
        }
        ';
        
    }
  }