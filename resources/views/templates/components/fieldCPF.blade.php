<script type="text/javascript">
     
//Masakara do cpf
$(function(){
$("#cpf").mask("999.999.999-99");
});

//Validação do CPF
$(function()
{
    //Executa a requisição quando o campo username perder o foco
    $('#cpf').blur(function()
    {        
        var cpf = $('#cpf').val().replace(/[^0-9]/g, '').toString();

        if( cpf.length == 11 )
        {
            var v = [];

            //Calcula o primeiro dígito de verificação.
            v[0] = 1 * cpf[0] + 2 * cpf[1] + 3 * cpf[2];
            v[0] += 4 * cpf[3] + 5 * cpf[4] + 6 * cpf[5];
            v[0] += 7 * cpf[6] + 8 * cpf[7] + 9 * cpf[8];
            v[0] = v[0] % 11;
            v[0] = v[0] % 10;

            //Calcula o segundo dígito de verificação.
            v[1] = 1 * cpf[1] + 2 * cpf[2] + 3 * cpf[3];
            v[1] += 4 * cpf[4] + 5 * cpf[5] + 6 * cpf[6];
            v[1] += 7 * cpf[7] + 8 * cpf[8] + 9 * v[0];
            v[1] = v[1] % 11;
            v[1] = v[1] % 10;

            //Retorna Verdadeiro se os dígitos de verificação são os esperados.
            if ( (v[0] != cpf[9]) || (v[1] != cpf[10]) )
            {     
                $("#labelCPF").addClass("has-error has-feedback");                
                $('#cpf').val(""); 
                $('#cpf').focus();
            }else{
                $("#labelCPF").removeClass("has-error has-feedback");
                $("#labelCPF").addClass("form-group has-success has-feedback");               
            }
        }
        else
        {            
            $("#labelCPF").addClass("has-error has-feedback");             
            $('#cpf').val("");           
            $('#cpf').focus();
            
        }
    });
});
</script>

<div id="labelCPF" class="form-group">
    <label for="func_CPF">CPF:</label><br/>
    <input type="text" maxlength="14" size="22" id="cpf" class="form-control" 
           name="{{$ent or "ent"}}_CPF" value="{{$resp['CPF'] or ""}}"   required="required" {{$enabledEdition['CPF'] or ""}} >
</div>

