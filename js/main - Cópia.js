$(document).ready(function(){
	$('.money').mask('000.000.000.000.000', {reverse: true});

	//Envio de e-mail ajax formulário topo
	$('#submit1').click(function(){
	 
		$.post("enviarEmail.php", $("#contatoTopo").serialize(),  function(response) {
				$('#success1').html(response);
				// $('#success1').hide(2000);
		});
		return false;
	 
	});	

	//Envio de e-mail ajax formulário topo
	$('#submit2').click(function(){
	 
		$.post("enviarEmail.php", $("#contatoBottom").serialize(),  function(response) {
				$('#success2').html(response);
				// $('#success2').hide(2000);
		});
		return false;
	 
	});		
//Validação de formulários
    
	$( "#simulaForm-FCO" ).validate({
	  rules: {
	    vf: {
	      required: true,
	      min: 5000,
	      max: 20000000
	    }
	  },
	  messages: {
	        vf: {
	            required: "Esse valor é obrigatório",
	            min: "O valor mínimo é R$ 5.000,00",
	            max: "O valor não pode ultrapassar R$ 20.000.000,00"
	        }
	    }	  
	});

	$( "#simulaForm-SUDECO" ).validate({
	  rules: {
	    vf: {
	      required: true,
	      min: 30000000,
	      max: 500000000
	    }
	  },
	  messages: {
	        vf: {
	            required: "Esse valor é obrigatório",
	            min: "O valor mínimo é R$ 30.000.000,00",
	            max: "O valor não pode ultrapassar R$ 500.000.000,00"
	        }
	    }	  
	});


})

