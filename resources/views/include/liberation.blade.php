{{ $countUnlock = 0, $status = 'L', $dtConfiance = '12/09/2021'}}
<script>
    $('.unlock').click(function (){
        Swal.fire({
        @if( $countUnlock === 0 and $dtConfiance < now())
            title: 'Liberação de Confiança',
            text: 'Sua internet foi liberada até que conste seu pagamento em nossos sistemas! Reinicie seus equipamentos para reconectar.',
            icon: 'success',
            timer: 6000,
            timerProgressBar: true,
        @elseif( $status )
        })
    })
</script>
