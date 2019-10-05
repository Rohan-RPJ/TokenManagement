<style type="text/css">
	
	.alert{
		border-radius: 5px;
		margin: 10px 0;
    	padding: 12px;
	}
	.alert-success{
		background-color: #DFF2BF;
		color: #4F8A10;
	}
	.alert-info {
    color: #00529B;
    background-color: #BDE5F8;
	}
	.alert-warning {
    color: #9F6000;
    background-color: #FEEFB3;
	}
	.alert-error {
    color: #D8000C;
    background-color: #FFD2D2;
	}

	.close{
		background-color: transparent;
		border-image: none !important;
		border:none !important;
		color:#bedb8f;
	}
	.close:hover{
		cursor: pointer; 
	}
	

</style>
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">X</button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">X</button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">X</button>	
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">X</button>	
	<strong>{{ $message }}</strong>
</div>
@endif

