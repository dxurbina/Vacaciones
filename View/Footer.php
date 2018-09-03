</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Sistema - Vacaciones
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="https://www.loto.com.ni/">Loto-Nicaragua</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
      <div  class="modal fade" id ="imodalusrI" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" style="margin: 15%; margin-top: 5%;" role="document">
                  <div style="width: 165%;" class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
                          
                      </div>
                      <form action="#" method="POST" name ="send">
                      <div class="modal-body">
                          <div class="row row-fluid">

                              <div class="col-sm-6">

                                      <div class="form-group"><label>Usuario</label></div>
                                      <div class="form-group"><input  id="usrI" name="Nombre"  required></input></div>
                                  

                                  
                              </div>
                              <div class="col-sm-6">
                                      <div class="form-group"><label>Contraseña</label></div>
                                      <div class="form-group"><input type="password" id="passI" name="Codigo" ID=""  required></input></div>
                                  

                                          
                              </div>
                              

                          </div>
                      </div>
                      <div class="modal-footer">
                          <input type="submit" class="btn btn-primary" id="btnUserI" value="Actualizar"></input>
                      </div>
                      
                      </form>
                  </div>
              </div>
      </div>



      <div  class="modal fade" id ="_modal_notif_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div style="width: 135%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actualizar saldo por csv</h4>
                    
                </div>
                
                <div class="modal-body">
                <div class="form-group"><label>Esta acción requiere de su autentificación.</label></div>
                    <div class="row row-fluid">
                   
                        <div class="col-sm-4">

                        <div class="form-group"><label>Ver archivo CSV</label></div>
                        <div class="form-group"><input type="submit" class="btn btn-primary" id="_download_" value="Descargar"></input></div>   
                        </div>
                        <div class="col-sm-4">

                                <div class="form-group"><label>Usuario</label></div>
                                <div class="form-group"><input class="store-val" value="<?php echo $_SESSION['nickname'] ?>" type="text" id="u" name="u"  readonly="readonly" /></div>   
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label>Contraseña</label></div>
                            <div class="form-group"><input class="store-val" type="password" id="pass_4" name="p"/></div>
                                
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                
                    <input type="submit" class="btn btn-primary" id="btn_update_csv_accepted" value="Deducir"></input>
                </div>
                
                
            </div>
        </div>
    </div>

      
</body>
  <script type ="text/javascript">
     var row;
    $(document).on('click', '.btn-usrI', function (e) {
    e.preventDefault();
      row = <?php echo $_SESSION['ID']->IdEmpleado; ?>;
      //console.log(row);
      showusrByIdSession();

    });

     function showusrByIdSession(){
        
        //console.log(obj);
        var obj = JSON.stringify({ id: row });
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=showUserById",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                dato = data;
                console.log(dato);
                $('#usrI').val(dato[0].usuario);
            }
        });
    }

    $(document).on('click', '#btnUserI', function (e) {
        e.preventDefault();

        var _select = $("#usrI").val();
        console.log(_select);
        var obj = JSON.stringify({ Nombre: _select });
        flag = false;
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=GetUser",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
              //  console.log(data);
                $(data).each(function(i, v){ // indice, valor
                    console.log(v.IdEmpleado);
                    if(v.Usuario == _select && v.IdEmpleado != row ){
                        flag = true;
                    }
                })
                if(flag == false){
                    var user = $('#usrI').val();
                    var pass = $('#passI').val();
                    if( pass.length > 4 && pass.length < 20 && user.length > 3){
                                
                                var obj = JSON.stringify({ Id: row, Usuario: user, Pass: pass });
                                flag = false;
                                $.ajax({
                                    data: obj,
                                    url: "?c=Empleado&a=updateUser",
                                    type: "POST",
                                    dataType: 'json',
                                    contentType: 'application/json; charset= utf-8',
                                    error: function(xhr, ajaxOptions, thrownError){
                                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                                    },
                                    success: function (data) {
                                        location.reload();
                                    }
                                        
                                    });  
                            
                    }else{
                        alert('Dato no esperado');
                    }
                    

                }else{
                    alert("Nombre de usuario ya existe!!");
                }
            }
                
            });

    });
  </script>


</html>