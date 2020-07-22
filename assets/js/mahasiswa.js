function deleteMHS(id){
  Swal.fire({
    title: 'Warning!',
    text: `Are you sure you want to delete id ${id}`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url:"mahasiswa/deleteDataMHS",  
        method:"post",
        beforeSend :function () {
        Swal.fire({
            title: 'Waiting',
            html: 'Proccess data',
            onOpen: () => {
              swal.showLoading()
            }
          })      
      },    
      data:{id:id},
        success:function(data){
          Swal.fire(
            'Deleted!',
            'Your data has been deleted.',
            'success'
          )
          $('#tablemhs').DataTable().ajax.reload()          
        }
      })
    } else if (result.dismiss === swal.DismissReason.cancel) {
      swalWithBootstrapButtons.fire(
        'Cancelled',
        'Your imaginary file is safe :)',
        'error'
      )
    }
  })
}
