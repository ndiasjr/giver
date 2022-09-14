<?php


namespace App\Models;


class LoadCSV extends Table
{

    protected function data($path,$filename){
        // carrega o arquivo.csv ignorando quebras de linha no final da linha e linhas vazias
        $file = file($path.$filename, FILE_TEXT | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // o caracter delimitador
        $delimitier = ',';

        // caso a primeira linha seja o cabeçalho (essa linha será removida da variável $file)
        $header = array_shift($file);

        // verifica se o delimitador existe
        if (!strpos($header, $delimitier)) {
            die('O delimitador: ( <b>' . $delimitier . '</b> ), não foi encontrado!');
        }

        // separa cada elemento do cabeçalho
        $header = explode($delimitier, $header);

        // inicia a variável para guardar os erros(se houver algum)
        $errors = [];

        // para cada linha em $file
        foreach ($file as $i => $line) {

            $arrayLine = explode($delimitier, $line);

            // verifica se a quantidade de colunas é igual às do header
            if (sizeof($arrayLine) != sizeof($header)) {
                $errors[] = 'A linha: <b>' . ($i + 2) . 'não tem o mesmo número de colunas!';
                continue;
            }

            // tratar os dados
            foreach ($arrayLine as $index => $value) {
                // se o valor estiver entre aspas simples, serão removidas
                $value = trim($value, "'");
                // se for numérico
                if (preg_match('/^[0-9.,]+$/', $value) && filter_var($value, FILTER_VALIDATE_INT)) {
                    // não precisa tratar o valor
                    $arrayLine[$index] = $value;
                } else {
                    // se não for numérico, o valor será tratato com utf-8, terá caracteres escapados e será colocado entre aspas simples
                    $arrayLine[$index] = "'" . addslashes(utf8_encode($value)) . "'";
                }
            }
            // coloca cada linha entre parenthesis
            $file[$i] = '(' . implode(', ', $arrayLine) . ')';
        }

        // se houver erros
        if (sizeof($errors)) {
            foreach ($errors as $error) {
                // mostra cada erro encontrado na tela
                echo '<p>' . $error . '</p>';
            }
        }
        // considera o cabeçalho como sendo iguais aos nomes das colunas do database
        $keys  = $header;
        $table = 'customers';

        // quebra as linhas em grupos de 1000 linhas
        $inserts = array_chunk($file, 1000, true);

        // para cada grupo de 1000 linhas
        foreach ($inserts as $v) {
            // adiciona a query de inserção no array $dump
            $dump[] = "insert into $table(`" . implode('`, `', $keys) . "`) values\n   " . implode(",\n     ", $v) . "\n";
        }

        // para cada grupo de 1000 inserções por insert em $dump
        foreach ($dump as $query) {
            // mostra na tela como ficou cada query de 1000 inserções por insert
            //echo '<pre>$query: ';
            //print_r($query);
            //echo '</pre>';

            // executa query de inserção no banco de dados
            $this->insert($query);
        }
    }
}