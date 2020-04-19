import { Component, OnInit,Input } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { Location }                 from '@angular/common';
import 'rxjs/add/operator/switchMap';

import { Product } from './product';
import { ProductService } from '../product.service';
import { AutenticationService } from '../autentication.service';



@Component({
  selector: 'detail-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.css']
})
export class ProductComponent implements OnInit {
    edit:boolean=false;
    add:boolean = false;
    rol:string = localStorage.getItem("rol")
    @Input() product:Product;

  constructor(
    private productService: ProductService,
    private route: ActivatedRoute,
    private location: Location,
    private autentication: AutenticationService
  ) { }

  ngOnInit() {
    this.autentication.checkCredentials()
    this.route.paramMap
    .switchMap((params: ParamMap) => this.productService.getProduct(+params.get('id')))
    .subscribe(product => this.product = product[0]);
  }

  goBack(): void {
    this.location.back();
  }
  
  goEdit(): void {
    this.edit = true;
  }


showAdd(): void {
    this.add = true;
  }
  
logout(){
       this.autentication.logout()

}
 
  save(): void {
    this.edit = false;

    this.productService.update(this.product)
      .then(() => this.goBack());
  }
   

}
