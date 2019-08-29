@extends('adminlte::page')

@section('title', 'Backup dos Registros')
@section('css')
    <style>
        .progressBar{
            background-color: #dadada;
            height: 10px;
                
        }
        .progress-bar{
            background-Color:green;
        }
        .color-green{
            color:green;
        }
        .container{
            display:flex;
            justify-content: center;
        }
        .box-parent{
            margin:2rem;
        }
        .btn{
            margin-bottom:2rem;
            border-radius:20px
        }
        .box p {
            margin:2rem;
        }
    </style> 
@stop
@section('content_header')
    <h1>Backup dos Registros</h1>
@stop

@section('content')
        <div class="row container">
            <div class="col-md-4 box-parent">
                <div class="box box-danger text-center">
                    <h3 class="header">Restaurar Database</h3>
                    <p>Restaura de um arquivo .SQL os registro. Isso irá apagar os registros de seu banco de dados atual!</p>
                        <button class="btn btn-danger" onclick="importData()">IMPORTAR</button>
                        <form id="form_import" action="{{ route('relatorio.backup')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input id="file-sql" type="file" name="file-sql" style="display: none;" />
                        </form>
                        {{ isset($import) ? $import : '' }}
                    <div class="col-md-12 text-center">
                    </div>
                </div> 
            </div>
            <div class="col-md-4 box-parent">
                <div class="box box-success text-center">
                    <h3 class="header">Exportar Database</h3>
                    <p>Salva todos os registro do seu banco de dados em um arquivo .SQL</p>
                        <a download="{{$mysql->filename}}" href="data:application/octet-stream;base64,{{$mysql->file}}" ><button class="btn btn-primary" type="button">EXPORTAR</button></a>
                    </div>
                </div>
            </div>
       <!--
    <div id="toLoad" class="box box-solid box-success">
        <div class="row"> 
            <div class="col-md-6"><h3 id="status" class="header text-center">Conectando</h3></div>
            
        </div>
        <div class="row"><div class="col-md-12 text-center" id="btn"></div></div>
        <div class="row"> 
            <div class="col-md-10 col-md-offset-1" id = "progressParent">

            </div>
        </div>
    </div>-->
    </div>
@stop
@section('js')
<script src="{{ asset('vendor/firebase.5.4.2/firebase-app.js') }}"></script>
<script src="{{ asset('vendor/firebase.5.4.2/firebase-storage.js') }}"></script>
<script src="{{ asset('vendor/firebase.5.4.2/firebase-auth.js') }}"></script>
<script src="{{ asset('vendor/firebase.5.4.2/firebase-database.js') }}"></script>
<script>
    document.getElementById('file-sql').onchange = function(e){
        document.getElementById('form_import').submit();
    };
    function importData(){
        document.getElementById('file-sql').click();
    }
    // var logged = false;
    // function setStatusText(text){
    //     var statusts= document.getElementById('status');
    //     statusts.innerHTML = text;
    // }
    // function addProgress(){
    //     var progress = '<div id="" class="progress progressBar"><div id="progressB" class="progress-bar" style="width: 0%"></div></div>'
    //     var prog = document.getElementById('progressParent');
    //     prog.innerHTML = progress;
    // }
    // function setProgress(progress){
    //     var progressB= document.getElementById('progressB');
    //     progressB.style.width = progress + "%";
    // }
    // function setButton(bool){
    //     var btnHTML = '<button class="btn btn-primary" onClick="sendBackup()">ENVIAR</button>';
    //     var btn = document.getElementById('btn');
    //     if(bool) btn.innerHTML = btnHTML;
    //     else{ 
    //         btn.innerHTML = '';
    //         addProgress();
    //     }
    // }
    // function setLoading(load){
    //     var loadingHTML = '<div id="loading" class="overlay"><i class="fa fa-refresh fa-spin"></i>';
    //     if(load){
    //         var toLoad= document.getElementById('toLoad');
    //         toLoad.innerHTML = toLoad.innerHTML + loadingHTML;
    //         setStatusText("Conectando servidor");
    //     }else{
    //         var loadHtml= document.getElementById('loading');
    //         loadHtml.parentNode.removeChild(loadHtml);
    //         setStatusText("Conectado!");
    //         setButton(true);
    //     }
    // }
    // Initialize Firebase
    // var config = {
    //     apiKey: "",
    //     authDomain: "",
    //     databaseURL: "",
    //     projectId: "",
    //     storageBucket: "",
    //     messagingSenderId: ""
    // };
    // firebase.initializeApp(config);

    // var connectedRef = firebase.database().ref(".info/connected");
    // connectedRef.on("value", function(snap) {
    //     if (snap.val() === true) {
    //         console.log("connected");
    //         setLoading(false);
    //     } else {
    //         console.log("not connected");
    //         setLoading(true); 
    //     }
    // });
    // firebase.auth().signInAnonymously().catch(function(error) {
    //     // Handle Errors here.
    //     var errorCode = error.code;
    //     var errorMessage = error.message;
    //     // ...
    // });
    // firebase.auth().onAuthStateChanged(function(user) {
    //     if (user) {
    //         var isAnonymous = user.isAnonymous;
    //         var uid = user.uid;
    //         logged = true;
    //     } else {
    //         logged = false;
    //     }
    // });
    function sendBackup(){
        if(!logged) { console.log("not logged"); return;}
        setButton(false);
        const storageRef = firebase.storage().ref('backupLoja');
        var message = '{{$mysql->file}}';
        var backup = storageRef.child('{{$mysql->filename}}').putString(message, 'base64');

        setStatusText("Iniciando envio");
        backup.on('state_changed', function(snapshot){
            var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
            setProgress(progress);
            console.log('Upload is ' + progress + '% done');
        }, function(error) {
            setStatusText("Erro: "+ error );
        }, function() {
            setStatusText("Envio completo! <i class='fa color-green fa-check-circle'></i>");
        });
    }
</script>
@stop