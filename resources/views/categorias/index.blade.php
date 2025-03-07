@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
          
            <div class="card border-dark shadow my-5">
                <div class="card-body p-10">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalagregarusuario">Crear Categorias</button>
                    </div>

                    <div class="table-responsive">
                        <table  align="center" class="table table-sm table-bordered table-striped table-hover" id="tablareporteAdministradorDataTable"  style="width:100%">
                        
                            <thead>
                                
                                <th class="text-center">ID</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Descripcion</th>
                                
                            </thead>
                            <tbody>


                                @forEach($categorias as $item )

                                    <tr>
                                        <td class="text-center">{{$item->id}}</td>
                                        <td class="text-center">{{$item->name}}</td>
                                        <td class="text-center">{{$item->descripcion}}</td>
                                    </tr>
                                

                                @endforeach

                            </tbody>
                        </table>
                     </div>
                     <form id="frmAgregarUsuario" method="POST" action="{{route ('categorias.store')}}">
                        @csrf
                        <!-- Modal -->
                        <div class="modal fade" id="modalagregarusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Nuevo Usuario</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                      
                              <div class="modal-body">
                      
                                <div class="row">
                      
                                  <div class="col-sm-8">
                                    <label for="nombre">Nombre de la categoria</label>
                                    <input type="text" class="form-control" id="name" name="name" required/> {{-- oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');  updateUsername();--}}
                                  </div>
                      
                      
                                </div>
                    
                                  <div class="col-sm-8">
                                    <label for="correo">Descripcion de la categoria</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" required/>  {{-- oninput="this.value = this.value.replace(/[^a-zA-Z0-9@._-]/g, '');" onblur="if (!isValidEmail(this.value)) alert('Por favor, ingrese un correo electrónico válido.');"   --}}
                                  </div>
                      
                      
                                </div>
                      
                                <div class="row">
                                 
                                    <div class="modal-footer w-3/4 m-auto">
                                        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                        <button class="btn btn-primary btn-sm">Crear Usuario</button>
                                    </div>
                      
                                </div>
                            </div>
                        </div>
                      
                            <style>
                              .bg-digitel {
                                background-color: #FF00FF;
                                color: white;
                              }
                              .bg-movistar {
                                background-color: #51C6D9;
                                color: white;
                              }
                              .bg-movilnet{
                                background-color: #f7bb34;
                                color: white;
                              }
                              .bg-default{
                                background-color: #f3f3f3;
                                color: black;
                              }
                            </style>
                        
                     </form>
                </div>
            </div>
        </div>        

    </div>
@endsection
