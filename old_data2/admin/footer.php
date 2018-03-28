  </div>
        <!-- /#page-wrapper -->

    </div>

</body>
<!-- DataTables JavaScript -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('.dataTable').DataTable({
        responsive: true
    });

    $('textarea').summernote();
});
</script>

</html>
