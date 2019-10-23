<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
Route::get('/', function () {
    return view('welcome');
});
*/



Auth::routes();

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@index')->name('home');
    Route::get('/clientes/cadastrar', 'ClientesController@index')->name('clientes.cadastrar');
    Route::post('/clientes/save', 'ClientesController@cadastrar')->name('clientes.save');
    Route::get('/clientes/todos', 'ClientesController@lista')->name('clientes.todos');
    Route::post('/cliente/editar', 'ClientesController@editar')->name('clientes.editar');
    Route::post('/cliente/saveeditar', 'ClientesController@saveEditar')->name('clientes.saveEdit');

    Route::get('/estoque/cadastrar', 'EstoqueController@index')->name('estoque.cadastrar');
    Route::post('/estoque/save', 'EstoqueController@cadastrar')->name('estoque.save');
    Route::get('/estoque/todos', 'EstoqueController@lista')->name('estoque.todos');

    /*Parametros de atributos */
    Route::get('/estoque/modal', 'EstoqueController@viewModal')->name('estoque.atributos.modal');
    Route::post('/estoque/somente-add', 'EstoqueController@addAtributo')->name('estoque.atributos.add');
    Route::get('/estoque/somente/{id}', 'EstoqueController@viewAtributos')->name('estoque.atributos');
    Route::get('/estoque/atributos', 'EstoqueController@viewAlterarAtributo')->name('estoque.editar.atributos');
    Route::post('/estoque/atributos', 'EstoqueController@saveAlterarAtributos')->name('estoque.editar.atributos');

    //API ESTOQUE
    Route::get('ap/estoque/', 'EstoqueController@APIListar')->name('estoque.api.listar');
    Route::post('ap/estoque/disponivel', 'EstoqueController@APIDisponivel')->name('estoque.api.disponivel');
    Route::get('ap/estoque/{id}', 'EstoqueController@APIFind')->name('estoque.api.find');
    Route::post('ap/estoque/', 'EstoqueController@saveEditar')->name('estoque.api.save');
    Route::post('ap/estoque/delete', 'EstoqueController@APIapagar')->name('estoque.api.delete');
    Route::post('ap/estoque/find', 'EstoqueController@APIprocurarEstoqueID')->name('estoque.api.estoqueID');

    //API Clientes
    Route::get('ap/cliente/', 'ClientesController@APIListar')->name('cliente.api.listar');
    Route::get('ap/cliente/{id}', 'ClientesController@APIFind')->name('cliente.api.find');
    //API Transacoes 
    //Route::get('ap/cliente/', 'VendasController@TransacoesAPIToday')->name('transacao.api.today');
    //Venda
    Route::get('/venda/', 'VendasController@vendasView')->name('venda');
    Route::post('/venda/', 'VendasController@Registrar')->name('venda.registrar');
    Route::get('/venda/cupom/', 'VendasController@GerarCupom')->name('venda.cupom.route');
    Route::get('/venda/cupom/{id}', 'VendasController@GerarCupom')->name('venda.cupom');
    Route::post('/venda/cancelar/', 'VendasController@CancelarVenda')->name('venda.cancelar');
    //CAIXA
    Route::get('/caixa/abrir', 'CaixaController@iniciarCaixaView')->name('caixa.abrir');
    Route::post('/caixa/abrir', 'CaixaController@iniciarCaixa')->name('caixa.abrir');
    Route::get('/caixa/fechar', 'CaixaController@fecharCaixaView')->name('caixa.fechar');
    Route::post('/caixa/fechar', 'CaixaController@fecharCaixa')->name('caixa.fechar');
    Route::get('/caixa/sangria', 'CaixaController@sangriaView')->name('sangria');
    Route::post('/caixa/sangria', 'CaixaController@sangriaPost')->name('sangria');
    Route::get('/caixa/adicionar', 'CaixaController@addCaixaView')->name('caixa.add');
    Route::post('/caixa/adicionar', 'CaixaController@addCaixa')->name('caixa.add');
    //Historico
    Route::get('/historico/', 'CaixaController@historico')->name('historico');
    Route::post('/historico/imprimir', 'CaixaController@historicoPrint')->name('historico.print');
    //Historico API
    Route::get('ap/historico/{type}/{id}', 'CaixaController@historicoAPI')->name('historico.api');
    Route::post('ap/historico/', 'CaixaController@historicoAPI')->name('historico.route');
    //Relatorio
    Route::get('/relatorio', 'RelatorioController@index')->name('relatorio');
    Route::get('/relatorio/ano/{id}', 'RelatorioController@index')->name('relatorio.ano');
    Route::get('/relatorio/backup', 'RelatorioController@BackupIndex')->name('relatorio.backup');
    Route::post('/relatorio/backup', 'RelatorioController@ImportBackup')->name('relatorio.backup');
    Route::get('/debug', 'ClientesController@debug')->name('clientes.debug');

    Route::get('admin/settings', 'UserSettings@index')->name('UserSettings.index');
    Route::post('admin/settings', 'UserSettings@edit')->name('UserSettings.edit');
});

Route::get('/mailable', function () { });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
