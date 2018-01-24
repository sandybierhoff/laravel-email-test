import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Headers, Http, RequestOptions, Response } from "@angular/http";

@Component({
    selector: '.m-wrapper',
    templateUrl: './blank.component.html',
    encapsulation: ViewEncapsulation.None,
})
export class BlankComponent implements OnInit {
    constructor(private http: Http) {
    }

    // test data     
    form = {
        emails: ['a@a.com'],
        subject: 'mio',
        to: 'a@a.com',
        body: 'mio'        
    }
    
    onAdd($event) {
        $event.stopPropagation();
        this.form.emails.push('');
    }

    onSend($event) {        
        $event.stopPropagation();
        return this.http.post('http://localhost:8000/api/send-email', this.form, this.jwt()).subscribe( response=> {
            let success = response.json().success;
            if( !success ) alert('Ocurrio un error mientras se enviaba un correo electronico.');
            else alert('Mensaje enviado correctamente');
        });        
    }

    ngOnInit() {
    }
    
    private jwt() {
        // create authorization header with jwt token
        let currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (currentUser && currentUser.token) {            
            let headers = new Headers({ 'Authorization': 'Bearer ' + currentUser.token });
            return new RequestOptions({ headers: headers });
        }
    }
}