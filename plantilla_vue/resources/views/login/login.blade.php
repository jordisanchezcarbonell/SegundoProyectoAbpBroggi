@extends('templates.main')

@section('titol')
    Login
@endsection

@section('main')

        <div class="container-fluid">
                
            <div class="logincenter">
                    <div class="row logincenter">
                
                        <div class="col-md-4 col-sm-12" style="padding-top: 15px; padding-bottom: 15px;">
                            <div class="card">
                                <div class="card-body" style="padding: 40px;">
                                  <h5 class="card-title" style="text-align: center;">LOGIN</h5>
                                    <form action="{{ action("LoginController@login")}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Correu electrònic</label>
                                      <input type="email" name="codi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Contrasenya</label>
                                      <input type="password" name="contrasenya" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div>
                                      <a href="{{ url('/register') }}" style="float:right;">No tinc un compte</a>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </form>
                                </div>
                              </div>
                        </div>
                    </div>
                            
            </div>
            
        </div>
    
@endsection