<script>
  $(document).on('click','.open_modal',function(){
      var url = "/akun";
      var akun_id= $(this).val();
      $.get(url + '/' + akun_id, function (data) {
          //success data
          console.log(data);
          $('#akun_id').val(data.id);
          $('#nomor').val(data.nomor);
          $('#nama').val(data.nama);
          $('#keterangan').val(data.keterangan);
          $('#btn-save').val("update");
          $('#myModal').modal('show');
      })
  });
</script>
