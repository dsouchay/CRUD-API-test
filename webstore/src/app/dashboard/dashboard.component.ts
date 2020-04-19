import { Component, OnInit } from '@angular/core';

import { Product } from '../product/product';
import { ProductService } from '../product.service';
import { AutenticationService } from '../autentication.service';


@Component({
  selector: 'my-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  title : string;
  products: Product[] = [];
  selectedProduct: Product;
  add:boolean=false;
  rol:string = localStorage.getItem("rol")

  constructor(private productService: ProductService,private autentication: AutenticationService) { }

  ngOnInit() {
     this.title = 'Product list of our WebStore';
     this.autentication.checkCredentials()
      this.productService.getProducts()
      .then(products =>{
        this.products = products;
        
      })
  }
onShow(): void {
  this.add = !this.add;
}

logout(){
       this.autentication.logout()

}

onSelect(product: Product): void {
  this.selectedProduct = product;
}




goAdd(name: string, available:boolean, price:DoubleRange,description:string ): void {
  this.add = false;
  name = name.trim();
  description = description.trim();
  if (!name || !price) { return; }
  this.productService.create(name,available,price,description)
    .then(product => {
     this.productService.getProducts()
        .then(products =>{
          this.products = products;
          
        })
    });
}      


  delete(product: Product): void {
  this.productService
      .delete(product.id)
      .then(() => {
        this.products = this.products.filter(h => h !== product);
        if (this.selectedProduct === product) { this.selectedProduct = null; }
      });
}


}
