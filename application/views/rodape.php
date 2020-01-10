
		</div>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
  		<script src="<?= base_url("js/popper.min.js") ?>"></script>
  		<script src="<?= base_url("js/bootstrap.min.js") ?>"></script>
  		<!--DATATABLES-->
        <script src="<?= base_url("js/jquery.dataTables.min.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/datatables/js/dataTables.buttons.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/datatables/js/jszip.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/datatables/js/pdfmake.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/datatables/js/vfs_fonts.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/datatables/js/buttons.html5.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/datatables/js/buttons.print.min.js'); ?>"></script>
  		<script type="text/javascript">
			function configDataTable(id_tabela = '') {
                var token = id_tabela;
                id_tabela = '#'+id_tabela;
			    $(''+id_tabela+'')
			    .wrap("<div class='dataTables_borderWrap "+ token+"' />")
			    .DataTable({
			    "order": [],				
                    "language": {
                        "url": "<?= base_url('ace-assets/js/dataTable-portugues.json'); ?>",
                       
                    },
					dom: 'Bfrtip',
						buttons: [
							{
								extend: 'pdf',
								text: 'Exportar PDF',
								className: 'btn btn-white btn-primary btn-bold',
								exportOptions: {
									modifier: {
										page: 'current'
									}
								}
							},
							{
								extend: 'excel',
								text: 'Exportar Excel',
								className: 'btn btn-white btn-primary btn-bold',
							}, 
							{
								extend: 'print',
								text: 'Imprimir',
								className: 'btn btn-white btn-primary btn-bold',
							}
							
						]

                });
        }
		</script>
		<script>
			$(document).ready(() => {

				$('#example').DataTable({
			    "order": [],				
                    "language": {
                        "url": "<?= base_url('ace-assets/js/dataTable-portugues.json'); ?>",
                        
                    },
					dom: 'Bfrtip',
						buttons: [
							{
								extend: 'pdf',
								text: 'Exportar PDF',
								className: 'btn btn-white btn-primary btn-bold',
								exportOptions: {
									modifier: {
										page: 'current'
									}
								}
							},
							{
								extend: 'excel',
								text: 'Exportar Excel',
								className: 'btn btn-white btn-primary btn-bold',
							}, 
							{
								extend: 'print',
								text: 'Imprimir',
								className: 'btn btn-white btn-primary btn-bold',
							}
							
						]

                });

				var $seuCampoCpf = $("#cpf");
    			$seuCampoCpf.mask('000.000.000-00', {reverse: true});
			})
		</script>
	</body>
</html>