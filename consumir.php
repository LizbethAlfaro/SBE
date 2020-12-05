<?php
include 'head.php';
?>
<div class="container">
     
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-search'></i> Alumnos </h4>
		</div>
		<div class="panel-body">
                    <input type="hidden" id="fecha" value="<?php echo $fecha;?>">
                    
                    <div class="form-group row text-center">
                        <div class="col-md-3">
                                    <label>Rut</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                               
                                            <input id="q" class="form-control">

                                        </div>
                                    </div>
                                </div>        
                            </div>
                    <div class="form-group row text-center">
                        <div class="col-md-3">
                                 
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                               
                                            <input class="btn btn-danger" type="button" onclick="json()" value="Enviar">

                                        </div>
                                    </div>
                                </div>        
                            </div>
                    
                    
  </div>
    
</div>
	
    <div class="panel panel-success">       
  <div class="table-responsive" style="overflow-y: auto; ">
 <div id="resultado"></div>   
 <table id="tableDinamic"></table><!-- Carga los datos ajax -->   
  
  
  </div>   
 </div> 
	</div>
<script type="text/javascript" src="service.js"></script>