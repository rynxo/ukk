<footer class="footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= BASE ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= BASE ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= BASE ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= BASE ?>dist/js/demo.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?= BASE ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= BASE ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= BASE ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= BASE ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= BASE ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= BASE ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= BASE ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= BASE ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= BASE ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= BASE ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= BASE ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>