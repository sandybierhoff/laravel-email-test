@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Send email</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="content">
                      
                      <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" placeholder="Subject" v-model="subject">
                      </div>    
                      <div class="form-group">
                        <label>Body</label>  
                        <textarea class="form-control" v-model="body" placeholder="Body content"></textarea>
                      </div>
                      <label>Emails</label>  
                      <div class="form-group" v-for="(i, k) in emails">                       
                        <input type="email" class="form-control" placeholder="Email" v-model="emails[k]">
                      </div>    
                      
                      <button type="button" @click="add()" class="btn btn-default">Add email</button>
                      <button type="button" @click="send()" class="btn btn-primary">Send Email</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content'), 'Authorization': 'Bearer {{ $token }}' }});
        new Vue({
            el: '#content',
            data:  function(){
                return {              
                    emails: [''],
                    subject: '',
                    body: ''
                };              
            },
            methods: {
                add: function() {                     
                    this.emails.push(''); 
                },
                send: function() {                     
                    var data = { token:'{{ $token }}', subject: this.subject, body: this.body, to: this.emails[0], cc:this.emails.slice(1) };
                      $.ajax({type: "POST", dataType: 'json', url: '/api/send-email', data: data}).then(this.onEmail, this.onError);
                },
                onError: function(e) {                     
                    alert(e.responseJSON.message);
                },
                onEmail: function(d) { 
                    alert('Email send ( sweetalert maybe.. )');
                }
            }
        });
    </script>
@stop