import { Injectable } from '@angular/core';
import { Http, Headers } from '@angular/http';
import 'rxjs/add/operator/toPromise';

import { Product } from './product/product';

@Injectable()
export class ProductService {

  private productUrl = 'http://localhost/store/apistore/products'; 
  private headers = new Headers({'Content-Type': 'application/json',
                                 'Access-Control-Allow-Origin': '*',
                                 'Access-Control-Allow-Method':'DELETE,GET,HEAD,POST,PUT,OPTIONS,TRACE'
                                });

  constructor(private http: Http) { }

  private handleError(error: any): Promise<any> {
    console.error('An error occurred', error); 
    return Promise.reject(error.message || error);
  }




  getProducts(): Promise<Product[]> {
  return this.http
              .get(this.productUrl)
              .toPromise()
              .then(response => response.json() as Product[])
              .catch(this.handleError);
  }

  delete(id: number): Promise<void> {
  const url = `${this.productUrl}/${id}`;
   return this.http
              .delete(url)
              .toPromise()
              .then(() => null)
              .catch(this.handleError);
}
  getProduct(id: number): Promise<Product> {
    const url = `${this.productUrl}/${id}`;
    return this.http
                .get(url)
                .toPromise()
                .then(response => response.json() as Product)
                .catch(this.handleError);
  }

 
    update(product: Product): Promise<Product> {
    const url = `${this.productUrl}/${product.id}`;
    var data = `{"name": "${product.name}","available": "${product.available}","price":"${product.price}","description": "${product.description}"}`
    
    return this.http
                .put(url,data)
                .toPromise()
                .then( (Response) => {
                                  var data = JSON.parse(Response['_body']);
                                  return Response;
                              },
                              err => console.log(err)) 
                             
                .catch(this.handleError );
  }


  create(name: string, available:boolean, price:DoubleRange,description:string): Promise<Product> {
  var data =JSON.stringify({name: name,available:available,price:price,description:description })
  return this.http
              .post(this.productUrl, data)
              .toPromise()
              .then(res => res.json().data as Product)
              .catch(this.handleError);
}


}
