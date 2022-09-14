<?php


namespace App\Models;

class Upload extends LoadCSV
{
    public $info;

    public function load(){
        // Extensão aceita
        $ext = array(".csv");
        //diretório para salvar os arquivos CSVs
        $dir = "data/";
        //Verificar a existência do diretório para salvar os arquivos CSVs e informar se o caminho é um diretório
        if(!is_dir($dir)) {
            $this->error = "Pasta $dir não existe no diretório";
        }else{
            $file = isset($_FILES['files']) ? $_FILES['files'] : FALSE;
            //loop para armazenar todos os arquivos carregados
            for ($i = 0; $i < count($file['name']); $i++){
                // Verifica se a extensão é CSV
                if (!in_array(strrchr($file['name'][$i], "."), $ext)) {
                    $this->error = $this->error. "A extensão do arquivo <b>" . $file['name'][$i] . "</b> não é válida<br>";
                }else{
                    $path = 'data/';
                    $filename = $file['name'][$i];
                    $file_exists = false;
                    // Verifica se o arquivo já foi importado
                    if(file_exists($path.$filename)){
                        $this->info = "O arquivo ".$filename." já existe no diretório<br>";
                    }else{
                        $to = $dir."/".$file['name'][$i];
                        //realiza o upload do arquivo
                        //move_uploaded_file — Move o arquivo CSV para a pasta destino no servidor
                        if(move_uploaded_file($file['tmp_name'][$i], $to)){
                            $this->data($path,$filename,$file_exists);
                        }else{
                            $this->error = $this->error. "Erro ao realizar upload do arquivo ".$filename."<br>";
                        }
                    }
                }
            }
            if(isset($this->success) && !empty($this->success) && isset($this->error) && !empty($this->error)){
                $this->info = $this->success.'<b class="text-danger">'.$this->error.'</b>';
            }
        }
    }
}