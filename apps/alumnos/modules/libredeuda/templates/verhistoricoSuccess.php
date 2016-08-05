<br />
<h1>Listado de consultas realizadas</h1>
<br />

<script type="text/javascript">
$(document).ready(function() {
	// Grilla
	jQuery("#grid").jqGrid({ 
		url:"<?php echo url_for('libredeuda/lista') ?>",
		datatype: "json", 
		colNames:['Id','Persona', 'Carrera', 'Mensaje', 'Usuario','Fecha'], 
		colModel:[ 
			{name:'id',index:'id', sorttype:"int", width:35, align:"center"},
	      	{name:'persona',index:'persona', width:60, align:"center", search:false},
			{name:'carrera',index:'carrera', width:200}, 
	      	{name:'mensaje',index:'mensaje', width:65, align:"center"},
	      	{name:'usuario',index:'usuario', width:65, align:"center"},
	      	{name:'created_at',index:'created_at', width:65, align:"center"},
		], 
		multiselect: false, 
		viewrecords: true,
		width: 600,
		height: 280,
		pager : "#pagerGrid",
		rowNum: 30, 
		rowList:[30,50,100], 
		caption: "Historico", 
		jsonReader : { 
			root: "rows", 
			page: "page", 
			total: "total", 
			records: "records", 
			repeatitems: true, 
			id: "id"
		}
	}); 	
	// Barra de navegacion
	jQuery("#grid").navGrid("#pagerGrid",{del:false,edit:false,add:false, search:true, view: true},{},{},{},{});	
});	
</script>
<table id="grid"></table>
<div id="pagerGrid"></div>
<br>