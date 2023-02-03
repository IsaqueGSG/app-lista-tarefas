<?php

require "../pasta _segura_servidor/tarefa.model.php";
require "../pasta _segura_servidor/tarefa.service.php";
require "../pasta _segura_servidor/conexao.php";

$acao = isset($_GET["acao"]) ? $_GET["acao"] : $acao ;

if( $acao =="inserir" ){
    $conexao = new Conexao() ;
    $tarefa = new Tarefa() ;
    $tarefa->__set("tarefa", $_POST["tarefa"]) ;
    
    $tarefaService = new TarefaService($conexao, $tarefa );
    $tarefaService->insert();
    header("location: nova_tarefa.php?inclusao=1") ;

} else if( $acao == "recuperar" ){

    $conexao = new Conexao() ;
    $tarefa = new Tarefa();

    $tarefaService = new TarefaService($conexao,$tarefa) ;
    $tarefas = $tarefaService->select();

} else if( $acao == "atualizar" ){

    $conexao = new Conexao() ;
    $tarefa = new Tarefa() ;
    $tarefa->__set("id" , $_POST["id"]) ;
    $tarefa->__set("tarefa" , $_POST["tarefa"]) ;

    $tarefaService = new TarefaService($conexao,$tarefa) ;
    if ( $tarefaService->update() ){
        
        $_GET['pag'] == "index" ? header("location: index.php") : 
        header("location: todas_tarefas.php") ;
    }

} else if( $acao == "excluir" ){

    $conexao = new Conexao() ;
    $tarefa = new Tarefa() ;
    $tarefa->__set("id" , $_GET["id"]) ;

    $tarefaService = new TarefaService($conexao,$tarefa) ;
    if ( $tarefaService->delete() ){

        $_GET['pag'] == "index" ? header("location: index.php") :
        header("location: todas_tarefas.php") ;
    }

} else if( $acao == "marcarRealizada" ){

    $conexao = new Conexao() ;
    $tarefa = new Tarefa() ;
    $tarefa->__set("id" , $_GET["id"]) ;
    $tarefa->__set("id_status" , 2 ) ;
    
    $tarefaService = new TarefaService($conexao,$tarefa) ;
    if ( $tarefaService->marcarRealizada() ){

        $_GET['pag'] == 'index' ? header("location: index.php") :
        header("location: todas_tarefas.php") ;
    }
} else if( $acao == "select_pendentes" ){

    $conexao = new Conexao() ;
    $tarefa = new Tarefa() ;
    
    $tarefaService = new TarefaService($conexao,$tarefa) ;
    $tarefas = $tarefaService->select_pendentes();
}

