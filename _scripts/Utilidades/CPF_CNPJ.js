function verifica_cpf_cnpj ( valor ) {

    valor = valor.toString();
    
    valor = valor.replace(/[^0-9]/g, '');

    if ( valor.length === 11 ) {
        return 'CPF';
    } 
    
    else if ( valor.length === 14 ) {
        return 'CNPJ';
    } 
    
    else {
        return false;
    }
    
}

function calc_digitos_posicoes( digitos, posicoes = 10, soma_digitos = 0 ) {

    digitos = digitos.toString();

    for ( var i = 0; i < digitos.length; i++  ) {

        soma_digitos = soma_digitos + ( digitos[i] * posicoes );

        posicoes--;

        if ( posicoes < 2 ) {
            posicoes = 9;
        }
    }

    soma_digitos = soma_digitos % 11;

    if ( soma_digitos < 2 ) {
        soma_digitos = 0;
    } else {
        soma_digitos = 11 - soma_digitos;
    }

    var cpf = digitos + soma_digitos;

    return cpf;
    
}

function valida_cpf( valor ) {

    valor = valor.toString();
    
    valor = valor.replace(/[^0-9]/g, '');

    var digitos = valor.substr(0, 9);

    var novo_cpf = calc_digitos_posicoes( digitos );

    var novo_cpf = calc_digitos_posicoes( novo_cpf, 11 );

    if ( novo_cpf === valor ) {
        return true;
    } else {
        return false;
    }
    
}

function valida_cnpj ( valor ) {

    valor = valor.toString();
    
    valor = valor.replace(/[^0-9]/g, '');


    var cnpj_original = valor;

    var primeiros_numeros_cnpj = valor.substr( 0, 12 );

    var primeiro_calculo = calc_digitos_posicoes( primeiros_numeros_cnpj, 5 );

    var segundo_calculo = calc_digitos_posicoes( primeiro_calculo, 6 );

    var cnpj = segundo_calculo;

    if ( cnpj === cnpj_original ) {
        return true;
    }
    
    return false;
    
}


function valida_cpf_cnpj ( valor ) {

    // Verifica se é CPF ou CNPJ
    var valida = verifica_cpf_cnpj( valor );

    // Garante que o valor é uma string
    valor = valor.toString();
    
    // Remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, '');


    // Valida CPF
    if ( valida === 'CPF' ) {
        // Retorna true para cpf válido
        return valida_cpf( valor );
    } 
    
    // Valida CNPJ
    else if ( valida === 'CNPJ' ) {
        // Retorna true para CNPJ válido
        return valida_cnpj( valor );
    } 
    
    // Não retorna nada
    else {
        return false;
    }
    
} // valida_cpf_cnpj

/*
 formata_cpf_cnpj
 
 Formata um CPF ou CNPJ

 @access public
 @return string CPF ou CNPJ formatado
*/
function formata_cpf_cnpj( valor ) {

    // O valor formatado
    var formatado = false;
    
    // Verifica se é CPF ou CNPJ
    var valida = verifica_cpf_cnpj( valor );

    // Garante que o valor é uma string
    valor = valor.toString();
    
    // Remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, '');


    // Valida CPF
    if ( valida === 'CPF' ) {
    
        // Verifica se o CPF é válido
        if ( valida_cpf( valor ) ) {
        
            // Formata o CPF ###.###.###-##
            formatado  = valor.substr( 0, 3 ) + '.';
            formatado += valor.substr( 3, 3 ) + '.';
            formatado += valor.substr( 6, 3 ) + '-';
            formatado += valor.substr( 9, 2 ) + '';
            
        }
        
    }
    
    // Valida CNPJ
    else if ( valida === 'CNPJ' ) {
    
        // Verifica se o CNPJ é válido
        if ( valida_cnpj( valor ) ) {
        
            // Formata o CNPJ ##.###.###/####-##
            formatado  = valor.substr( 0,  2 ) + '.';
            formatado += valor.substr( 2,  3 ) + '.';
            formatado += valor.substr( 5,  3 ) + '/';
            formatado += valor.substr( 8,  4 ) + '-';
            formatado += valor.substr( 12, 14 ) + '';
            
        }
        
    } 

    // Retorna o valor 
    return formatado;
    
} // formata_cpf_cnpj