import { Injectable } from '@angular/core';
import { RouterModule, Router } from '@angular/router';
import { Http, Headers } from '@angular/http';




export class User {
  constructor(
    public email: string ='',
    public password: string ='',
    public rol: string =''

    
    ) { }
}
 

@Injectable()
export class AutenticationService {

  private autenticationtUrl = 'http://localhost/store/apiuser/user';  
  private headers = new Headers({'Content-Type': 'application/json'});

  constructor(private http: Http ,  private _router: Router) { }

  private handleError(error: any): Promise<any> {
    console.error('An error occurred', error); 
    return Promise.reject(error.message || error);
  }


 
  logout() {
    localStorage.removeItem("user");
    localStorage.removeItem("rol");
    this._router.navigate(['login']);
  }
 
  login(pUser){
   this.CheckUser(pUser.email,pUser.password)
        .then((response)=>{
        var content = JSON.parse(JSON.stringify(response))
        content = content._body

        var session = []
          JSON.parse(content, 
                      (key, value) =>
                        session[key]=value 
                    )
  

        if (session['email'] && session['id_rol']){
          localStorage.setItem("user",session['email']) 
          localStorage.setItem("rol",session['id_rol']) 
          this._router.navigate(['dashboard'])
          return true
         }
     
        })

    return false;
 
  }
 
   checkCredentials(){
    if (localStorage.getItem("user") === null){
        this._router.navigate(['login'])
    }

  }

    CheckUser(pemail:string,ppass:string): Promise<User> {
    const url = `${this.autenticationtUrl}`
    var data =`{"user":"${pemail}","password":"${ppass}"}` 
    return this.http
                .post(url,data, {headers: this.headers})
                .toPromise()
                .then(
                   (Response) => { return Response}
                   )
                .catch(this.handleError)
  }
 
}