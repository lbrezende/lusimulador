$(document).ready(function(){
	//$('.money').mask('000.000.000.000.000', {});

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

	//Validação de formulários FCO
$( "#simulaForm-FCO" ).validate({
	  rules: {
	    vf: {
	      required: true,
	     
	      max: 20000000
	    }
	  },
	  messages: {
	        vf: {
	            required: "Esse valor é obrigatório",
	            max: "O valor não pode ultrapassar R$ 20.000.000,00"
	        }
	    }	  

	})
	
	
	//Validação de forlários SUDECO
$( "#simulaForm-SUDECO" ).validate({
	  rules: {
	    vf: {
	      required: true,
	     
	      min: 3000000000,
		  max: 5000000000
	    }
	  },
	  messages: {
	        vf: {
	            required: "Esse valor é obrigatório",
				min: "O menor valor é R$ 30.000.000,00",
	            max: "O valor não pode ultrapassar R$ 50.000.000,00"
	        }
	    }	  

	});
	
	
})
