<div class="container-fluid" >
    <form action="" id="book-form" >
        <div class="form-group">
            <input name="package_id" type="hidden" value="<?php echo $_GET['package_id'] ?>" >
            <input type="date" class='form form-control' id = "minDate"  onload="onload()" name='schedule'  required>
        </div>
    </form>
</div>
<script>
	$(document).ready(function () {
		var today1 = new Date().toISOString().split('T')[0];
		$("#minDate").attr('min', today1);
	});
	
	function onload()
	{
	  var today = new Date();
	  var dd = today.getDate();
	  var mm = today.getMonth()+1; 
	  var yyyy = today.getFullYear();
	  yyyy = parseInt(yyyy) + 1;
	  today = dd+'-'+mm+'-'+yyyy;
	  document.getElementById("minDate").value = today;
	}
	
	
    $(function(){
        $('#book-form').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=book_tour",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("Book Request Successfully sent.")
                        $('.modal').modal('hide')
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    }
                    end_loader()
                }
            })
        })
    })
</script>