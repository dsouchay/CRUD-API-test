import { Component, OnInit } from '@angular/core';
import { AutenticationService } from '../autentication.service';
import { User } from '../autentication.service';


@Component({
  selector: 'my-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
   providers: [AutenticationService]
})
export class LoginComponent implements OnInit {
  pUser = new User;
  errorMsg : string;

  constructor( private _service:AutenticationService) { 
    
    this.pUser.email='';
    this.pUser.password='';
    this.errorMsg = '';
     }


 
    ngOnInit(){
        this._service.checkCredentials();
    }

    login(){
      var pass;
      pass= this._service.login( this.pUser);
      console.log(pass);
      if (!pass) {
        this.errorMsg = ' Invalid Credentials';
        this.pUser.email='';
        this.pUser.password='';
      }
    }
 
    logout() {
        this._service.logout();
    }

}
